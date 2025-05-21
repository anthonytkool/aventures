<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
// หน้า Tours ทั้งหมด
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');

// หน้า Home
Route::get('/', function () {
    $tours = \App\Models\Tour::all();
    return view('home', compact('tours'));
})->name('home');

// หน้า Tour รายการเดียว
Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');

// หน้า Booking Form
Route::get('/bookings/{tour}', [BookingController::class, 'create'])->name('booking.form');

// บันทึก Booking
Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');



