<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;


class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        return view('tours.index', compact('tours'));
    }
}
