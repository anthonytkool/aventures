<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverseasController extends Controller
{
    public function index()
    {
        $overseasTours = [
            [
                'image' => 'BT-DAD32_EK_0.jpg',
                'title' => 'มหัศจรรย์เวียดนามกลาง',
                'desc' => 'เวียดนามกลาง ดานัง ฮอยอัน เว้ บินตรงสู่เวียดนามกลาง สัมผัสธรรมชาติและวัฒนธรรม',
                'pdf' => 'Smile-BT-DAD32_EK.pdf',
                'price' => 25999,
                'duration' => '4 วัน 3 คืน',
                'slug' => 'vietnam-central',
            ],
            [
                'image' => 'BT-DAD082_VZ_0.jpg',
                'title' => 'เวียดนามกลาง ไฮไลท์',
                'desc' => 'ดานัง เว้ ฮอยอัน บานาฮิลล์ เดินสะพานมือทอง
ชมเมืองสวย อาหารอร่อย กับราคาสุดคุ้ม',
                'pdf' => 'Smile-BT-DAD082_VZ.pdf',
                'price' => 23999,
                'duration' => '4 วัน 3 คืน',
                'slug' => 'vietnam-highlight',
            ],
            [
                'image' => 'BT-KIX_A01_XJ_0.jpg',
                'title' => 'Osaka Kyoto Sakura',
                'desc' => 'ชมซากุระที่โอซาก้าและเกียวโต เที่ยวเมืองดัง
ช็อปปิ้งสุดมันส์ สัมผัสวัฒนธรรมญี่ปุ่นแท้',
                'pdf' => 'Smile-BT-KIX_A01_XJ.pdf',
                'price' => 42999,
                'duration' => '5 วัน 3 คืน',
                'slug' => 'osaka-kyoto-sakura',
            ],
            [
                'image' => 'BT-KIX_A05_XJ_0.jpg',
                'title' => 'Osaka Kyoto Premium',
                'desc' => 'เที่ยวเต็มอิ่มโอซาก้า เกียวโต นารา พร้อมกิจกรรมสุดพิเศษ
อิ่มอร่อยกับอาหารญี่ปุ่น เที่ยวครบจุใจ',
                'pdf' => 'Smile-BT-KIX_A05_XJ.pdf',
                'price' => 45999,
                'duration' => '5 วัน 3 คืน',
                'slug' => 'osaka-kyoto-premium',
            ],
            [
                'image' => 'BT-NRT_A02_XJ_0.jpg',
                'title' => 'Tokyo Fuji',
                'desc' => 'เยือนโตเกียว เมืองฟูจิ สัมผัสธรรมชาติ
ช็อปปิ้งเต็มวัน เที่ยวแลนด์มาร์คสุดฮิต',
                'pdf' => 'Smile-BT-NRT_A02_XJ.pdf',
                'price' => 47999,
                'duration' => '5 วัน 3 คืน',
                'slug' => 'tokyo-fuji',
            ],
            [
                'image' => 'BT-TPE16_VZ_0.jpg',
                'title' => 'Taiwan Chill',
                'desc' => 'ไต้หวันสุดชิลล์ เที่ยวครบทุกไฮไลท์
ชิมอาหารอร่อย ช้อปปิ้งจุใจในไทเป',
                'pdf' => 'Smile-BT-TPE16_VZ.pdf',
                'price' => 29999,
                'duration' => '4 วัน 3 คืน',
                'slug' => 'taiwan-chill',
            ],
            [
                'image' => 'BT-DAD88_FD_0.jpg',
                'title' => 'ดานัง ฮอยอัน ฟีลดี',
                'desc' => 'ดานัง ฮอยอัน เว้ สัมผัสวัฒนธรรมเวียดนามกลาง
พักโรงแรมดี อาหารจัดเต็ม เที่ยวชิลล์สบาย',
                'pdf' => 'Smile-BT-DAD88_FD.pdf',
                'price' => 21999,
                'duration' => '4 วัน 3 คืน',
                'slug' => 'vietnam-danang-feelgood',
            ],
            [
                'image' => 'BT-JAI23_FD.jpg',
                'title' => 'Jaipur India',
                'desc' => 'สำรวจ Jaipur เมืองมรดกโลก อินเดีย
ชมพระราชวังสีชมพู สัมผัสวัฒนธรรมอินเดียแท้',
                'pdf' => 'Smile-BT-JAI23_FD.pdf',
                'price' => 33999,
                'duration' => '5 วัน 4 คืน',
                'slug' => 'jaipur-india',
            ],
            [
                'image' => 'BT-MMR16_8M_0.jpg',
                'title' => 'มหัศจรรย์เมียนมา',
                'desc' => 'เที่ยวมัณฑะเลย์ ย่างกุ้ง สักการะพระเจดีย์
สัมผัสวัฒนธรรมและวิถีชีวิตเมียนมา',
                'pdf' => 'Smile-BT-MMR16_8M.pdf',
                'price' => 18999,
                'duration' => '4 วัน 3 คืน',
                'slug' => 'myanmar',
            ],
            [
                'image' => 'BT-MMR55_8M_0.jpg',
                'title' => 'เมียนมา ไหว้พระ',
                'desc' => 'มัณฑะเลย์ พุกาม ไหว้พระมหาเจดีย์
เที่ยววัดดัง ขอพรเสริมสิริมงคล',
                'pdf' => 'smile-BT-MMR55_8M.pdf',
                'price' => 16999,
                'duration' => '4 วัน 3 คืน',
                'slug' => 'myanmar-temple',
            ],
            [
                'image' => 'NRT03_XJ_0.jpg',
                'title' => 'Tokyo Freeday',
                'desc' => 'โตเกียวอิสระเต็มวัน ช็อปปิ้งและเที่ยวเพลิน
สัมผัสเมืองหลวงญี่ปุ่นในสไตล์คุณเอง',
                'pdf' => 'Smile-BT-NRT03_XJ.pdf',
                'price' => 23999,
                'duration' => '5 วัน 3 คืน',
                'slug' => 'tokyo-freeday',
            ],
        ];

        return view('overseas', compact('overseasTours'));
    }
}
