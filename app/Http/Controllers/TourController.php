<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * แสดงรายการทัวร์ทั้งหมด พร้อม filter ตามประเทศและค้นหาด้วยคำค้นหา
     */
    public function index(Request $request)
    {
        $query = Tour::query();

        if ($request->has('country') && $request->country != '') {
            $query->where('country', $request->country);
        }

        $tours = $query->paginate(12);

        return view('tours.index', compact('tours'));
    }


    /**
     * แสดงรายละเอียดทัวร์แบบรายตัว
     */
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('tours.show', compact('tour'));
    }
}
