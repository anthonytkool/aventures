<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class PageController extends Controller
{
    public function home()
    {
        $tours = Tour::whereNotNull('image_url')->get();
        return view('home', compact('tours'));
    }

    public function about()
    {
        return view('about');
    }
}

