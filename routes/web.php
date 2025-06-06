<?php

use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home'); // ✅ หน้าหลักใช้ controller แล้ว
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');

Route::get('/bookings/{tour}', [BookingController::class, 'create'])->name('booking.form');
Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
