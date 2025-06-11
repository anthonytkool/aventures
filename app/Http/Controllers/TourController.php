<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use Carbon\Carbon;

class TourController extends Controller
{
    /**
     * แสดงรายการทัวร์ทั้งหมด พร้อม filter ตามประเทศและค้นหาด้วยคำค้นหา
     */
public function index(Request $request)
{
    $query = \App\Models\Tour::query();

    if ($request->has('country') && $request->country != '') {
        $query->where('country', $request->country);
    }

    $tours = $query->latest()->get();

    return view('tours.index', compact('tours'));
}




    /**
     * แสดงรายละเอียดทัวร์แบบรายตัว
     */
    public function show($id)
    {
        $tour = Tour::with('departures')->findOrFail($id);
        return view('tours.tourdetails', compact('tour'));
    }
}
