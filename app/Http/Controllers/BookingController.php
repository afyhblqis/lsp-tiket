<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Menampilkan halaman detail sebelum memesan
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view("user.booking_detail", compact('schedule'));
    }

    // Memproses pesanan ke database
    public function store(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'total_seats' => 'required|integer|min:1',
        ]);

        $total_price = $request->total_seats * $schedule->price;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'total_seats' => $request->total_seats,
            'total_price' => $total_price,
            'status' => 'pending'
        ]);

        // kurangi stok
        $schedule->decrement('stock', $request->total_seats);

        // redirect ke halaman pembayaran
        return redirect()->route('payment.show', $booking->id);
    }

    // ✅ TAMBAHAN BARU (HALAMAN PAYMENT)
    public function payment($id)
    {
        $booking = Booking::with('schedule')->findOrFail($id);
        return view('user.booking_user', compact('booking'));
    }

    // Menampilkan riwayat
    public function history()
    {
        $orders = Booking::where('user_id', Auth::id())
            ->with('schedule')
            ->latest()
            ->get();

        return view('user.history', compact('orders'));
    }

    // Halaman detail setelah pembayaran
    public function detail($id)
    {
        $booking = Booking::with('schedule')->findOrFail($id);
        return view('user.booking_result', compact('booking'));
    }

    // Upload bukti pembayaran
    public function uploadPayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'payment_method' => 'required',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('payment_proof');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $booking->update([
            'payment_method' => $request->payment_method,
            'payment_proof' => $filename,
            'payment_status' => 'waiting_verification'
        ]);

        return redirect()->route('booking.detail', $booking->id)
            ->with('success', 'Bukti pembayaran berhasil dikirim');
    }
}
