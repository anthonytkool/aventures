<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    // แสดงรายการทัวร์ทั้งหมด
    public function index(Request $request)
    {
        $query = Tour::query();

        // Filter by country (ใช้ LIKE เพื่อรองรับหลายประเทศ)
        if ($request->has('country')) {
            $country = $request->input('country');
            $query->where('country', 'LIKE', '%' . $country . '%');
        }

        // Filter by series
        if ($request->has('series')) {
            $series = $request->input('series');
            $query->where('series', $series);
        }

        $tours = $query->get();
        return view('tours.index', compact('tours'));
    }

    // แสดงรายละเอียดทัวร์ตามไอดีหรือ slug
 public function show($slug)
{
    $tour = Tour::where('slug', $slug)->firstOrFail();
    return view('tours.show', compact('tour'));
}
    // แสดงวันเดินทางของทัวร์
    public function showDepartures($id)
    {
        $tour = Tour::findOrFail($id);
        $departures = $tour->departures;
        return view('tours.departures', compact('tour', 'departures'));
    }

    // แสดงฟอร์มจองทัวร์
    public function showBooking($tourId, $departureId)
    {
        $tour = Tour::findOrFail($tourId);
        $departure = $tour->departures()->findOrFail($departureId);
        return view('bookings.create', compact('tour', 'departure'));
    }
}