<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    // แสดงหน้ารวมทัวร์ทั้งหมด
    public function index(Request $request)
    {
        $query = Tour::query();

        if ($request->has('country') && $request->country != '') {
            $query->where('country', $request->country);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('start_location', 'like', '%'.$request->search.'%');
            });
        }

        $tours = $query->paginate(9);
        return view('tours.index', compact('tours'));
    }

    // แสดงรายละเอียดทัวร์
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('tours.tourdetails', compact('tour'));
    }
}
