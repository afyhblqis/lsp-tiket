<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;


class BookingController extends Controller
{
    // Menampilkan halaman detail sebelum memesan
   public function show($id)
    {
    $schedule = Schedule::findOrFail($id); // FIX (tanpa S)
        return view("user.booking_detail", compact('schedule'));
}
    // Memproses pesanan ke database
    public function store(Request $request, $id)
    {
    $schedule = Schedule::findOrFail($id);

    $request->validate([
        'total_seats' => 'required|integer|min:1',
        'payment_method' => 'required',
        'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $total_price = $request->total_seats * $schedule->price;

    // Upload file
    $file = $request->file('payment_proof');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads'), $filename);

    Booking::create([
        'user_id' => Auth::id(),
        'schedule_id' => $schedule->id,
        'total_seats' => $request->total_seats,
        'total_price' => $total_price,
        'status' => 'Lunas',
        'payment_method' => $request->payment_method,
        'payment_proof' => $filename,
        'payment_status' => 'pending'
    ]);

    $schedule->decrement('stock', $request->total_seats);

    return redirect('/history');
}

    //Menampilknan riwayat pemesanan
    public function history()
    {
        $orders = Booking::where('user_id', Auth::id())
        ->with('schedule')
        ->latest()
        ->get();

        return view('user.history', compact('orders'));

    }

public function detail($id)
{
    $booking = Booking::with('schedule')->findOrFail($id);

    return view('user.booking_user', compact('booking'));
}

    public function uploadPayment(Request $request, $id)
    {
    $booking = Booking::findOrFail($id);

    $request->validate([
        'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $file = $request->file('payment_proof');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads'), $filename);

    $booking->update([
        'payment_proof' => $filename,
        'payment_status' => 'pending'
    ]);

    return back();
    }


}

