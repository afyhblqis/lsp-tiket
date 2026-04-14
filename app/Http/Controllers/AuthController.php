<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Booking;


class AuthController extends Controller
{
    public function login() {return view('auth.login');}
    public function register() {return view('auth.register');}

    public function postRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
        return redirect('/');
    }

public function postLogin(Request $request)
{
    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect('/dashboard');
    }
    return back();
}

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            $schedules = Schedule::latest()->get();
            $bookings = Booking::with(['user', 'schedule'])->latest()->get();
            return view('admin.dashboard', compact('schedules', 'bookings'));
        }

        $schedules = Schedule::where('stock', '>', 0)->get();
        return view('user.dashboard', compact('schedules'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
