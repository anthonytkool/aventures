<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverseasController extends Controller
{
    public function index()
    {
        $overseasTours = [
            [
                'image' => 'tour1.jpg',
                'title' => 'Japan Explorer',
                'desc' => 'เที่ยวญี่ปุ่นสุดมันส์',
                'pdf' => 'japan-tour.pdf',
                'price' => 29900,
                'duration' => '5 Days',
                'slug' => 1,
            ],
            [
                'image' => 'tour2.jpg',
                'title' => 'Swiss Alps',
                'desc' => 'สำรวจเทือกเขาแอลป์',
                'pdf' => 'swiss-tour.pdf',
                'price' => null,
                'duration' => null,
                'slug' => 2,
            ],
            // เพิ่มรายการอื่นๆ ตามต้องการ
        ];

        return view('overseas', compact('overseasTours'));
    }
}