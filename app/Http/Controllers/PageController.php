<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function index()
    {
        $popularTours = Tour::latest()->take(6)->get();
        return view('home', ['tours' => $popularTours]);
    }
}
