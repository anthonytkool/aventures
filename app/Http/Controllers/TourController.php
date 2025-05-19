<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = \App\Models\Tour::all();
        return view('tours.index', compact('tours'));
    }

    public function show($id)
    {
        $tour = Tour::with('schedules')->findOrFail($id);
        $recommendedTours = Tour::where('id', '!=', $id)->take(4)->get();
        return view('tours.show', compact('tour', 'recommendedTours'));
    }
}
