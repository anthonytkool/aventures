<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;


class TourController extends Controller
{
    public function index(Request $request)
{
    $query = Tour::with('images'); // <-- สำคัญมาก

    if ($request->filled('country')) {
    $query->where('country', $request->country);
}


    $tours = $query->get();

    return view('tours.index', compact('tours'));
}

    public function show($id)
    {
        $tour = Tour::with(['images', 'departures'])->findOrFail($id);
        return view('tours.tourdetails', compact('tour'));
    }
}
