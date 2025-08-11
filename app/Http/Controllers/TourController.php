<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    // แสดงรายการทัวร์ทั้งหมด
   public function index(\Illuminate\Http\Request $request)
{
    $query = \App\Models\Tour::query();

    // รับพารามฯ country แบบ string ปกติ (กัน Stringable สะดุด)
    $raw = (string) $request->query('country', '');
    $country = trim($raw);

    if ($country !== '') {
        // มองว่าเป็น "ทัวร์ซีรีส์/ข้ามพรมแดน" ถ้าชื่อมีคำว่า cross-border หรือ series
        $isSeries = preg_match('/cross[\-\s]?border/i', $country)
                 || strcasecmp($country, 'series') === 0
                 || strcasecmp($country, 'Cross-Border Trips Series') === 0;

        if ($isSeries) {
            // เงื่อนไขซีรีส์: มีค่าในคอลัมน์ series หรือ category=series
            // หรือ country เป็นแบบคอมม่า (ทริปหลายประเทศ)
            $query->where(function ($q) {
                $q->whereNotNull('series')
                  ->orWhere('category', 'series')
                  ->orWhere('country', 'like', '%,%');
            });
        } else {
            // ค้นหาตามประเทศ: ทั้งในคอลัมน์ country และใน pivot 'countries'
            $like = "%{$country}%";
            $query->where(function ($q) use ($like, $country) {
                $q->where('country', 'like', $like)
                  ->orWhereHas('countries', function ($cq) use ($country) {
                      $cq->where('name', $country);
                  });
            });
        }
    }

    $tours = $query->orderByDesc('created_at')->paginate(12);

    return view('tours.index', compact('tours', 'country'));
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