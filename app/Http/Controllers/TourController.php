<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    // แสดงรายการทัวร์ทั้งหมด
    public function index()
    {
        $tours = Tour::all();
        return view('tours.index', compact('tours'));
    }

    // แสดงรายละเอียดทัวร์ตามไอดีหรือ slug
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('tours.show', compact('tour'));
    }

    // แสดงวันเดินทางของทัวร์
    public function showDepartures($id)
    {
        $tour = Tour::findOrFail($id);
        $departures = $tour->departures; // สมมุติว่ามี relation departures ใน model
        return view('tours.departures', compact('tour', 'departures'));
    }

    // แสดงฟอร์มจองทัวร์
    public function showBooking($tourId, $departureId)
    {
        $tour = Tour::findOrFail($tourId);
        // สมมุติว่ามี relation departures ใน model
        $departure = $tour->departures()->findOrFail($departureId);
        return view('bookings.create', compact('tour', 'departure'));
    }
}
