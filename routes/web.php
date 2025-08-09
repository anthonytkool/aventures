<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminTourController;
use App\Http\Controllers\OverseasController;

// ✅ Homepage
Route::get('/', [PageController::class, 'index'])->name('home');

// ✅ Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ✅ Tours (Frontend)
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');

// ✅ Tour Detail (uses slug)
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tour.show');

// ✅ Departures
Route::get('/tours/{tour}/departures', [TourController::class, 'showDepartures'])->name('tours.departures');

// ✅ Booking
Route::get('/bookings/{tour}/departure/{departure}', [TourController::class, 'showBooking'])->name('bookings.departure');
Route::post('/bookings/{tour}/departure/{departure}', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{tour}', [BookingController::class, 'create'])->name('bookings.create');
Route::get('/booking/{tourId}/{departureId}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');



// ✅ Thank You Page (make sure you have resources/views/thankyou.blade.php)
Route::get('/thankyou', function() {
    return view('thankyou');
})->name('thankyou');

// ✅ Overseas Tours (NEW)
Route::get('/tours/overseas', [PageController::class, 'overseas'])->name('overseas.index');

// ✅ Tours Overseas (Optional legacy)
Route::get('/tours/overseas', [PageController::class, 'overseas'])->name('overseas.tours');



// ✅ FAQ Page
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// ✅ Admin
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('tours', AdminTourController::class);
});