<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;   // เติมบรรทัดนี้เพื่อให้เจอคลาส Controller

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }
}
