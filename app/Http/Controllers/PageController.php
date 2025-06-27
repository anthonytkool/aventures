<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Tour;



class PageController extends Controller
{
   public function index()
{
    $tours = \App\Models\Tour::with('images')->latest()->take(8)->get();

    // เอา Outbound Tours แค่ 3 รายการสำหรับหน้าแรก
    $outboundTours = [
    [
        'title' => 'Vietnam 3 Days 2 Nights',
        'desc' => 'Includes Danang, Hoi An, Ba Na Hills',
        'image' => 'vietnam-tour.png',
        'pdf' => 'vietnam-tour.pdf',
    ],
    [
        'title' => 'Hongkong 5 Days 4 Nights',
        'desc' => 'Includes Tokyo, Osaka, Mt. Fuji',
        'image' => 'hongkongJuly.png',
        'pdf' => 'hongkongP.pdf',
    ],
    [
        'title' => 'Singapore 3 Days 2 Nights',
        'desc' => 'Includes Marina Bay, Sentosa',
        'image' => 'hongkong.png', // ใช้ภาพแทนสิงคโปร์ชั่วคราว
        'pdf' => null,
    ],
];


    return view('home', compact('tours', 'outboundTours'));
}



    public function about()
    {
        return view('about');         // or 'pages.about' if your Blade is in resources/views/pages/about.blade.php
    }
    public function outbounds()
    {
        // (ข้อมูลเทียมสำหรับแสดงในหน้าทัวร์ต่างประเทศ)
       $outboundTours = [
    [
        'title' => 'Vietnam 3 Days 2 Nights',
        'desc' => 'Includes Danang, Hoi An, Ba Na Hills',
        'image' => 'vietnam-tour.png',
        'pdf' => 'vietnam-tour.pdf',
    ],
    [
        'title' => 'Hongkong 5 Days 4 Nights',
        'desc' => 'Includes Tokyo, Osaka, Mt. Fuji',
        'image' => 'hongkongJuly.png',
        'pdf' => 'hongkongP.pdf',
    ],
    [
        'title' => 'Singapore 3 Days 2 Nights',
        'desc' => 'Includes Marina Bay, Sentosa',
        'image' => 'hongkong.png', // ใช้ภาพแทนสิงคโปร์ชั่วคราว
        'pdf' => null,
    ],
];


        // return view('outbound', compact('outboundTours'));
       return view('outbound', compact('outboundTours')); // ✅ ถูกต้อง
    }
}
