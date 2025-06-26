<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Tour;



class PageController extends Controller
{
    public function index()
    {
        $tours = \App\Models\Tour::with('images')->latest()->take(8)->get();

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
                'image' => 'hongkong.png',
                'pdf' => null,
            ],
            [
                'title' => 'Japan Spring Tour',
                'desc' => 'Tokyo, Osaka, Mt. Fuji',
                'image' => 'japan.png',
                'pdf' => 'japan.pdf',
            ],
            [
                'title' => 'Taiwan Delight',
                'desc' => 'Taipei, Jiufen, Taroko Gorge',
                'image' => 'taiwan.png',
                'pdf' => 'taiwan.pdf',
            ],
            [
                'title' => 'Vietnam Central',
                'desc' => 'Hue, Hoi An, Da Nang',
                'image' => 'vietnam-central.png',
                'pdf' => 'vietnam-central.pdf',
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
                'image' => 'hongkong.png',
                'pdf' => null, // no PDF = Coming Soon
            ],
            [
                'title' => 'Japan Spring Tour',
                'desc' => 'Tokyo, Osaka, Mt. Fuji',
                'image' => 'japan.png',
                'pdf' => 'japan.pdf',
            ],
            [
                'title' => 'Taiwan Delight',
                'desc' => 'Taipei, Jiufen, Taroko Gorge',
                'image' => 'taiwan.png',
                'pdf' => 'taiwan.pdf',
            ],
            [
                'title' => 'Vietnam Central',
                'desc' => 'Hue, Hoi An, Da Nang',
                'image' => 'vietnam-central.png',
                'pdf' => 'vietnam-central.pdf',
            ],
        ];

        return view('tours.outbound', compact('outboundTours'));
    }
}
