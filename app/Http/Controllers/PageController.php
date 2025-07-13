<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class PageController extends Controller
{
   public function index()
{
    $tours = Tour::with('images')->latest()->take(8)->get();

    // ✅ ทัวร์ 6 รายการจริงสำหรับหน้า HOME เท่านั้น (ใช้โฟลเดอร์ highlight-outbounds)
    $outboundTours = [
        [
            'title' => 'ล่าแสงเหนือ มหัศจรรย์แห่งธรรมชาติ!!! 10 วัน 8 คืน',
            'desc' => 'ไอซ์แลนด์ ตามล่าแสงเหนือ โรงแรมเน้น Location เห็นแสงเหนือ มีโอกาสเห็นทุกคืน !!!',
            'image' => 'BT-ICE22_AY.jpg',
            'pdf' => 'PROGRAM-BT-ICE22_AY.pdf',
        ],
        [
            'title' => 'มหัศจรรย์...ฝรั่งเศส สวิส อิตาลี นั่งรถไฟด่วน 2 สาย 10 วัน 7 คืน',
            'desc' => 'ทริปสุดโรแมนติก 10 วัน 7 คืน หอไอเฟล ล่องเรือแม่น้ำแซน โคลอสเซียม หอเอนเมืองปีซ่า นั่งกระเช้า Eiger Express สู่ยอดเขา จุงฟราว',
            'image' => 'BT-EUR778_EK.jpg',
            'pdf' => 'PROGRAM-BT-EUR778_EK.pdf',
        ],
        [
            'title' => 'Russia Autumn – Amazing รัสเซีย มอสโคว มหานครเซนต์ปีเตอร์เบิร์ก ฤดูใบไม้ร่วง',
            'desc' => 'เที่ยวมอสโก–เซนต์ปีเตอร์เบิร์ก 8 วัน 5 คืน ล่องเรือแม่น้ำ มินิออโต้โชว์ ครบทุกไฮไลต์ พร้อมอาหาร 16 มื้อ และพักโรงแรม 4 ดาว',
            'image' => 'BT-DME22_EK.jpg',
            'pdf' => 'PROGRAM-BT-DME22_EK.pdf',
        ],
        [
            'title' => 'Europe Grand Tour – ฝรั่งเศส สวิตเซอร์แลนด์ อิตาลี',
            'desc' => '9 วัน 7 คืน ครบ 3 ประเทศยุโรป เที่ยวครบทุกแลนด์มาร์กไฮไลต์ พักโรงแรม 3–4 ดาว พร้อมบริการเต็มรูปแบบ เดินทางช่วง เม.ย.–ต.ค. 68 กับสายการบิน Emirates',
            'image' => 'BT-EUR978_EK.jpg',
            'pdf' => 'PROGRAM-BT-EUR978_EK.pdf',
        ],
        [
            'title' => 'Turkiye Delight – สัมผัสดินแดน 2 ทวีป',
            'desc' => '8 วัน 6 คืน เยือนอิสตันบูล นั่งบอลลูนชมคัปปาโดเกีย ชมมัสยิด Blue Mosque บลูมอสก์ พร้อมโชว์ Belly Dance และแช่น้ำแร่ธรรมชาติ Pamukkale พักโรงแรมดี เดินทางช่วง ก.ค.–ส.ค. 68 โดย Turkish Airlines',
            'image' => 'BT-IST53_TK.jpg',
            'pdf' => 'PROGRAM-BT-IST53_TK.pdf',
        ],
        [
            'title' => 'East America – นิวยอร์ก วอชิงตัน ดี.ซี.',
            'desc' => '10 วัน 6 คืน ล่องเรือน้ำตกไนแองการ่า ชมความงามของอ่าว ฮัตสัน ชมเทพีเสรีภาพ ชมเพชรเม็ดงามแห่งมหานครนิวยอร์ก Times Square, Statue of Liberty, ทำเนียบขาว และอีกมากมาย',
            'image' => 'BT-USA01_QR.jpg',
            'pdf' => 'PROGRAM-BT-USA01_QR.pdf',
        ],
    ];

    return view('home', compact('tours', 'outboundTours'));
}


    public function about()
    {
        return view('about');
    }

    public function outbound()
    {
        $outboundTours = [
            [
                'title' => 'ทัวร์อินเดีย 5 วัน 3 คืน',
                'desc' => 'สัมผัสวัฒนธรรมอินเดีย แสวงบุญ พุทธคยา',
                'image' => 'BT-JAI23_FD.jpg',
                'pdf' => 'Smile-BT-JAI23_FD.pdf',
            ],
            [
                'title' => 'โอซาก้า โตเกียว 6 วัน 4 คืน',
                'desc' => 'เที่ยวครบ 2 เมืองดังของญี่ปุ่น บิน XJ',
                'image' => 'BT-KIX_A01_XJ_0.jpg',
                'pdf' => 'Smile-BT-KIX_A01_XJ.pdf',
            ],
            [
                'title' => 'โอซาก้า เกียวโต นารา 5 วัน 3 คืน',
                'desc' => 'ทริปสุดฮิต ครบวัฒนธรรมและธรรมชาติ',
                'image' => 'BT-KIX_A05_XJ_0.jpg',
                'pdf' => 'Smile-BT-KIX_A05_XJ.pdf',
            ],
            [
                'title' => 'โตเกียว ฟูจิ 5 วัน 3 คืน',
                'desc' => 'ชมภูเขาไฟฟูจิ ช้อปปิ้งเต็มอิ่มที่ชินจูกุ',
                'image' => 'BT-NRT_A02_XJ_0.jpg',
                'pdf' => 'Smile-BT-NRT_A02_XJ.pdf',
            ],
            [
                'title' => 'โตเกียว ฟูจิ นิกโก้ 6 วัน',
                'desc' => 'พิเศษ! เที่ยวนิกโก้ เมืองมรดกโลก',
                'image' => 'NRT03_XJ_0.jpg',
                'pdf' => 'Smile-BT-NRT03_XJ.pdf',
            ],
            // 🔸 Placeholder อีก 7 รายการ
            [
                'title' => 'ชื่อทัวร์เดโม่ 1',
                'desc' => 'คำอธิบายทัวร์เดโม่สั้น ๆ',
                'image' => 'demo1.jpg',
                'pdf' => null,
            ],
            [
                'title' => 'ชื่อทัวร์เดโม่ 2',
                'desc' => 'รายละเอียดกำลังจะมาเร็ว ๆ นี้',
                'image' => 'demo2.jpg',
                'pdf' => null,
            ],
            [
                'title' => 'ชื่อทัวร์เดโม่ 3',
                'desc' => 'ข้อมูลทัวร์จะอัปเดตในเร็ว ๆ นี้',
                'image' => 'demo3.jpg',
                'pdf' => null,
            ],
            [
                'title' => 'ชื่อทัวร์เดโม่ 4',
                'desc' => 'ทัวร์ต่างประเทศพิเศษ รอติดตาม',
                'image' => 'demo4.jpg',
                'pdf' => null,
            ],
            [
                'title' => 'ชื่อทัวร์เดโม่ 5',
                'desc' => 'รายละเอียด Coming Soon',
                'image' => 'demo5.jpg',
                'pdf' => null,
            ],
            [
                'title' => 'ชื่อทัวร์เดโม่ 6',
                'desc' => 'ข้อมูลทัวร์ใหม่จะมาเร็ว ๆ นี้',
                'image' => 'demo6.jpg',
                'pdf' => null,
            ],
            [
                'title' => 'ชื่อทัวร์เดโม่ 7',
                'desc' => 'รายละเอียดกำลังเตรียมการอัปโหลด',
                'image' => 'demo7.jpg',
                'pdf' => null,
            ],
        ];

        return view('outbound', compact('outboundTours'));
    }
}
