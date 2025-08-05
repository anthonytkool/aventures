<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\TourController as AdminTourController;

// ✅ Homepage
Route::get('/', [PageController::class, 'index'])->name('home');

// ✅ Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ✅ Tours (Frontend)
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');
Route::get('/tours/{tour}/departures', [TourController::class, 'showDepartures'])->name('tours.departures');

// ✅ Booking
Route::get('/bookings/{tour}/departure/{departure}', [TourController::class, 'showBooking'])->name('bookings.departure');
Route::post('/bookings/{tour}/departure/{departure}', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{tour}', [BookingController::class, 'create'])->name('bookings.create');
Route::get('/booking/{tourId}/{departureId}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/thankyou', function() {
    return view('thankyou');
})->name('thankyou');

// ✅ Outbound/Faq
Route::get('/tours/outbound', [PageController::class, 'outbound'])->name('outbound.tours');
Route::get('/outbounds', [PageController::class, 'outbound'])->name('outbounds');
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// ✅ Admin
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('tours', AdminTourController::class);
});