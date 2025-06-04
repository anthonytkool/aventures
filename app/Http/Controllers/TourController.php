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

        // กรองตามประเทศ
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // กรองด้วยคำค้นหาชื่อทัวร์หรือสถานที่เริ่มต้น
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('start_location', 'like', '%' . $request->search . '%');
            });
        }

        // แสดงผลแบบแบ่งหน้า
        $tours = $query->paginate(12);

        return view('tours.index', compact('tours'));
    }

    /**
     * แสดงรายละเอียดทัวร์แบบรายตัว
     */
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('tours.tourdetails', compact('tour'));
    }
}
