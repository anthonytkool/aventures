<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;

Route::get('/', function () {
    return view('home'); // ← เส้นทางหน้าแรก
});

Route::get('/tours', [TourController::class, 'index'])->name('tours.index'); // ← ต้องอยู่นอกวงเล็บ!



