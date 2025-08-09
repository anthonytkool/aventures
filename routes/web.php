<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminTourController;
use App\Http\Controllers\OverseasController;
use App\Http\Controllers\HomeController;

// หน้าแรก (ใช้ HomeController เท่านั้น)
Route::get('/', [HomeController::class, 'index'])->name('home');

// หน้าเกี่ยวกับ/ติดต่อ
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ทัวร์ต่างประเทศ (เฉพาะ) -- ต้องอยู่ก่อน /tours/{slug}
Route::get('/tours/overseas', [OverseasController::class, 'index'])->name('overseas.index');
Route::get('/overseas', [OverseasController::class, 'index'])->name('overseas.index');

// ทัวร์ในประเทศ
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');

// รายละเอียดทัวร์ (Wildcard)
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tour.show');
Route::get('/tours/{tour}/departures', [TourController::class, 'showDepartures'])->name('tours.departures');

// Booking
Route::get('/bookings/{tour}/departure/{departure}', [TourController::class, 'showBooking'])->name('bookings.departure');
Route::post('/bookings/{tour}/departure/{departure}', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{tour}', [BookingController::class, 'create'])->name('bookings.create');
Route::get('/booking/{tourId}/{departureId}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Thank You Page
Route::get('/thankyou', function() {
    return view('thankyou');
})->name('thankyou');

// FAQ
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Admin
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('tours', AdminTourController::class);
});