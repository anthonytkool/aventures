<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OverseasController;
use App\Http\Controllers\Admin\AdminTourController;

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/

// หน้าแรก
Route::get('/', [HomeController::class, 'index'])->name('home');

// เกี่ยวกับ & ติดต่อ
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ทัวร์ต่างประเทศ (หน้าไฮไลต์แบบคงที่)
Route::get('/overseas', [OverseasController::class, 'index'])->name('overseas.index');

/*
|--------------------------------------------------------------------------
| Tours
|--------------------------------------------------------------------------
*/

// รายการทัวร์ (รองรับ ?country=Thailand / Laos / Vietnam / Cross-Border Trips Series)
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');

// วันออกเดินทางของทัวร์ (ใช้ slug)
Route::get('/tours/{tour:slug}/departures', [TourController::class, 'showDepartures'])
    ->name('tours.departures');

// รายละเอียดทัวร์ (ใช้ slug)
Route::get('/tours/{tour:slug}', [TourController::class, 'show'])
    ->name('tour.show');

/*
|--------------------------------------------------------------------------
| Bookings
|--------------------------------------------------------------------------
| หมายเหตุ: โปรเจกต์ของคุณตั้งค่า model binding ให้ Tour ใช้ slug แล้ว
| เลยผูก {tour:slug} ให้ชัดเจนที่นี่
*/

// เลือกวันออกเดินทางของทัวร์ (หน้า pre-booking)
Route::get('/bookings/{tour:slug}/departure/{departure}', [TourController::class, 'showBooking'])
    ->name('bookings.departure');

// ส่งฟอร์มจองจากหน้าข้างบน
Route::post('/bookings/{tour:slug}/departure/{departure}', [BookingController::class, 'store'])
    ->name('bookings.store');

// หน้าเริ่มจอง (ถ้าต้องการรองรับเข้าตรงจากทัวร์)
Route::get('/bookings/{tour:slug}', [BookingController::class, 'create'])
    ->name('bookings.create');

/* Legacy aliases (คงไว้กันลิงก์เก่าแตกได้)
   - ใช้ id ตรง ๆ กรณีลิงก์ภายนอกเก่า ๆ */
Route::get('/booking/{tourId}/{departureId}', [BookingController::class, 'create'])
    ->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])
    ->name('booking.store');

/*
|--------------------------------------------------------------------------
| Static pages
|--------------------------------------------------------------------------
*/

Route::get('/thankyou', fn () => view('thankyou'))->name('thankyou');
Route::get('/faq', fn () => view('faq'))->name('faq');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('tours', AdminTourController::class);
});
