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
    
    public function outbound()
{
    $outboundTours = [
        [
            'title' => 'Vietnam 3 Days 2 Nights',
            'desc' => 'Includes Danang, Hoi An, Ba Na Hills',
            'image' => 'vietnam.jpg',
            'pdf' => 'vietnam.pdf',
        ],
        [
            'title' => 'Hongkong 5 Days 4 Nights',
            'desc' => 'Includes Tokyo, Osaka, Mt. Fuji',
            'image' => 'hongkong.jpg',
            'pdf' => 'hongkong.pdf',
        ],
        [
            'title' => 'Singapore 3 Days 2 Nights',
            'desc' => 'Includes Marina Bay, Sentosa',
            'image' => 'singapore.jpg',
            'pdf' => '',
        ],
        // 🔻 เพิ่มอีก 9 รายการ
        [
            'title' => 'Japan 5 Days 4 Nights',
            'desc' => 'Includes Tokyo, Kyoto, Mt. Fuji',
            'image' => 'japan.jpg',
            'pdf' => 'japan.pdf',
        ],
        [
            'title' => 'Korea 4 Days 3 Nights',
            'desc' => 'Seoul, Nami Island, Everland',
            'image' => 'korea.jpg',
            'pdf' => 'korea.pdf',
        ],
        [
            'title' => 'Taiwan 4 Days 3 Nights',
            'desc' => 'Taipei, Jiufen, Shifen',
            'image' => 'taiwan.jpg',
            'pdf' => 'taiwan.pdf',
        ],
        [
            'title' => 'Maldives 5 Days',
            'desc' => 'Resort stay with activities',
            'image' => 'maldives.jpg',
            'pdf' => 'maldives.pdf',
        ],
        [
            'title' => 'Dubai 5 Days 4 Nights',
            'desc' => 'Desert Safari, Burj Khalifa',
            'image' => 'dubai.jpg',
            'pdf' => 'dubai.pdf',
        ],
        [
            'title' => 'Turkey 8 Days 7 Nights',
            'desc' => 'Istanbul, Cappadocia',
            'image' => 'turkey.jpg',
            'pdf' => 'turkey.pdf',
        ],
        [
            'title' => 'Switzerland 7 Days',
            'desc' => 'Zurich, Lucerne, Interlaken',
            'image' => 'switzerland.jpg',
            'pdf' => 'switzerland.pdf',
        ],
        [
            'title' => 'Australia 6 Days',
            'desc' => 'Sydney, Melbourne',
            'image' => 'australia.jpg',
            'pdf' => 'australia.pdf',
        ],
        [
            'title' => 'New Zealand 7 Days',
            'desc' => 'Auckland, Queenstown',
            'image' => 'newzealand.jpg',
            'pdf' => 'newzealand.pdf',
        ],
    ];

    return view('outbound', compact('outboundTours'));
}

}
