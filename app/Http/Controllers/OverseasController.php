<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverseasController extends Controller
{
    public function index()
    {
        $overseasTours = [
            [
                'title' => 'ล่าแสงเหนือ มหัศจรรย์แห่งธรรมชาติ!!! 10 วัน 8 คืน',
                'desc' => 'ไอซ์แลนด์ ตามล่าแสงเหนือ โรงแรมเน้น Location เห็นแสงเหนือ มีโอกาสเห็นทุกคืน !!!',
                'image' => 'BT-ICE22_AY.jpg',
                'pdf' => 'PROGRAM-BT-ICE22_AY.pdf',
            ],
            // ... เพิ่มรายการอื่นๆ ตามต้องการ
        ];

        return view('overseas', compact('overseasTours'));
    }
}