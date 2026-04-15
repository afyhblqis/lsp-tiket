<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

//Guest: Login & Register
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

// Khusus user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.index');
    Route::post('/booking/{id}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/history', [BookingController::class, 'history'])->name('booking.history');

    Route::get('/admin/schedules/create', [AdminScheduleController::class, 'create']);
    Route::post('/admin/schedules/store', [AdminScheduleController::class, 'store']);
    Route::get('/admin/schedules/edit/{id}', [AdminScheduleController::class, 'edit']);
    Route::post('/admin/schedules/update/{id}', [AdminScheduleController::class, 'update']);
    Route::get('/admin/schedules/delete/{id}', [AdminScheduleController::class, 'destroy']);

    //Route::get('/admin/bookings', [AdminBookingController::class, 'index']);

    //update bagian booking
    Route::get('/booking/detail/{id}', [BookingController::class, 'detail']);
    Route::post('/booking/upload/{id}', [BookingController::class, 'uploadPayment']);

    //admin verivikasi pembayaran
    Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
    Route::get('/admin/bookings/approve/{id}', [AdminBookingController::class, 'approve']);
    Route::get('/admin/bookings/reject/{id}', [AdminBookingController::class, 'reject']);

    // dialihkan ke pembayaran
    Route::get('/payment/{id}', [BookingController::class, 'payment'])->name('payment.show');
    Route::post('/payment/{id}', [BookingController::class, 'uploadPayment'])->name('payment.upload');
    Route::get('/booking-user/{id}', [BookingController::class, 'detail'])->name('booking.detail');
});
