<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Models\Tour;

Route::get('/tours', [TourController::class, 'index'])->name('tours.index'); // << ต้องอยู่บนก่อน



Route::get('/', function () {
    $tours = \App\Models\Tour::all();
    return view('home', compact('tours'));
})->name('home');
