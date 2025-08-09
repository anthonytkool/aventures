<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $tourIds = [1, 2, 3, 4, 5, 6, 7];

        $query = Tour::with('countries')
            ->whereIn('id', $tourIds);

        if ($request->has('country')) {
            $query->whereHas('countries', function ($q) use ($request) {
                $q->where('name', $request->country);
            });
        }

        $tours = $query->get()->sortBy(function ($tour) use ($tourIds) {
            return array_search($tour->id, $tourIds);
        });

        // ส่งข้อมูลทัวร์ไปที่ home.blade.php
        return view('home', compact('tours'));
    }

    public function about()
    {
        return view('about');
    }
}