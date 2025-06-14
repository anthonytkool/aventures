<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\TourAdminController;

// ✅ Homepage
Route::get('/', [PageController::class, 'index'])->name('home');


// ✅ Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ✅ Tours (Frontend)
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');

// ✅ Bookings (User booking flow)
Route::get('/bookings/{tour}', [BookingController::class, 'create'])->name('bookings.create'); // Show form
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');        // Submit form

// ✅ Admin Routes (Tour Management)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('tours', TourAdminController::class);
});
