<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\TourAdminController;

// ✅ Homepage
Route::get('/', [PageController::class, 'index'])->name('home');

// ✅ Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about'); // <-- ใช้แค่บรรทัดนี้
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// ✅ Tours (Frontend)
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show'); // 👈 เพิ่มอันนี้



// ✅ Tour Departures (Calendar)
Route::get('/tours/{tour}/departures', [TourController::class, 'showDepartures'])->name('tours.departures');

// ✅ Booking
Route::get('/bookings/{tour}/departure/{departure}', [TourController::class, 'showBooking'])->name('bookings.departure');
Route::post('/bookings/{tour}/departure/{departure}', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{tour}', [BookingController::class, 'create'])->name('bookings.create');

// ✅ Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('tours', TourAdminController::class);
});

Route::get('/tours/outbound', [PageController::class, 'outbound'])->name('outbound.tours');
Route::get('/outbounds', [PageController::class, 'outbounds'])->name('outbounds');



