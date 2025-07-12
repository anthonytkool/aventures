<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class PageController extends Controller
{
    public function index()
    {
        $tours = Tour::with('images')->latest()->take(8)->get();

        $outboundTours = [
            [
                'title' => 'มหัศจรรย์...INDIA ชัยปุระ นครสีชมพู',
                'desc' => '4 วัน 2 คืน สัมผัสมนต์เสน่ห์ชัยปุระ นครสีชมพู พร้อมแวะชม “รถจี๊ปขึ้นแอเมอร์ ฟอร์ท” และ “City Palace”',
                'image' => 'BT-JAI23_FD.jpg',
                'pdf' => 'Smile-BT-JAI23_FD.pdf',
            ],
            [
                'title' => 'มหัศจรรย์...OSAKA นาโมะบาโนซาโตะ',
                'desc' => '5 วัน 3 คืน ตื่นตากับ “นาโมะบาโนซาโตะ” และทาคายาม่า พร้อมชมงานแสง สี เสียงที่ยิ่งใหญ่',
                'image' => 'BT-KIX_A01_XJ_0.jpg',
                'pdf' => 'Smile-BT-KIX_A01_XJ.pdf',
            ],
            [
                'title' => 'มหัศจรรย์...OSAKA ชุดกิโมโน เกียวโต FREEDAY',
                'desc' => '5 วัน 3 คืน ใส่กิโมโนเที่ยวเมืองเกียวโต เยือนถนนชิโจ โดริ วัดชินจูซันเกนโด และช้อปปิ้งย่านดัง',
                'image' => 'BT-KIX_A05_XJ_0.jpg',
                'pdf' => 'Smile-BT-KIX_A05_XJ.pdf',
            ],
            [
                'title' => 'มหัศจรรย์...TOKYO ฟูจิ นาริตะ FREEDAY',
                'desc' => '5 วัน 3 คืน ท่องโตเกียว Fuji นาริตะ พร้อมฟรีเดย์เลือกกิจกรรมเองตามใจ และรับประกันเที่ยวสื่อสารภาษาญี่ปุ่น',
                'image' => 'BT-NRT_A02_XJ_0.jpg',
                'pdf' => 'Smile-BT-NRT_A02_XJ.pdf',
            ],
            [
                'title' => 'มหัศจรรย์...TOKYO เรนโบว์เฟสติวัล 2025',
                'desc' => '5 วัน 3 คืน ชมเทศกาลเรนโบว์เฟสติวัล ปี 2025 พร้อมเล่นน้ำแช่ออนเซ็นสุดสบาย',
                'image' => 'NRT03_XJ_0.jpg',
                'pdf' => 'Smile-NRT03_XJ.pdf',
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
        // ✅ ทัวร์จริง 5 รายการ
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
            'pdf' => 'Smile-NRT03_XJ.pdf',
        ],

        // 🔸 Placeholder อีก 7 รายการ (แก้ภายหลังได้)
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
