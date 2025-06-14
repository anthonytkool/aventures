<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Tour;



class PageController extends Controller
{
    public function index()
    {
        $tours = \App\Models\Tour::with('images')->latest()->take(8)->get();
        return view('home', compact('tours'));
    }

    public function about()
    {
        return view('about');         // or 'pages.about' if your Blade is in resources/views/pages/about.blade.php
    }
}
