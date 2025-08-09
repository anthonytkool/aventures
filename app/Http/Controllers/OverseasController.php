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

        return view('overseas', compact('overseasTours'));
    }
}