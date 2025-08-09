<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $tourIds = [1, 2, 3, 4, 5, 6, 7];

        $query = Tour::with('countries')
            ->whereIn('id', $tourIds);

        if ($request->has('country')) {
            $query->whereHas('countries', function ($q) use ($request) {
                $q->where('name', $request->country);
            });
        }

        $tours = $query->get()->sortBy(function ($tour) use ($tourIds) {
            return array_search($tour->id, $tourIds);
        });

        // ✅ ทัวร์ 6 รายการจริงสำหรับหน้า HOME เท่านั้น
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

    public function about()
    {
        return view('about');
    }


    public function overseas()
    {
        $overseasTours = [
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
            [
                'title' => 'เวียดนามกลาง ดานัง ฮอยอัน บานาฮิลล์',
                'desc' => 'สะพานมือ เมืองโบราณฮอยอัน เที่ยวสบาย บิน FD',
                'image' => 'BT-DAD88_FD_0.jpg',
                'pdf' => 'Smile-BT-DAD88_FD.pdf',
            ],
            [
                'title' => 'พม่า มัณฑะเลย์ พุกาม สกายน์',
                'desc' => 'ไหว้พระมหามุนี ขึ้นเขามัณฑะเลย์ ฮิลล์',
                'image' => 'BT-MMR16_8M_0.jpg',
                'pdf' => 'smile-BT-MMR16_8M.pdf',
            ],
            [
                'title' => 'พม่า มัณฑะเลย์ พุกาม',
                'desc' => 'เจดีย์ชเวสิกอง มหาเจดีย์ชเวดากอง',
                'image' => 'BT-MMR55_8M_0.jpg',
                'pdf' => 'smile-BT-MMR55_8M.pdf',
            ],
            [
                'title' => 'ไต้หวัน ไทเป ไทจง',
                'desc' => 'นั่งกระเช้าเหมาคง ทะเลสาบสุริยันจันทรา',
                'image' => 'BT-TPE16_VZ_0.jpg',
                'pdf' => 'Smile-BT-TPE16_VZ.pdf',
            ],
            [
                'title' => 'เวียดนามใต้ โฮจิมินห์ ดาลัด',
                'desc' => 'เมืองแห่งดอกไม้ เมืองโรแมนติกที่สุดในเวียดนาม',
                'image' => 'BT-DAD32_EK_0.jpg',
                'pdf' => 'Smile-BT-DAD32_EK.pdf',
            ],
            [
                'title' => 'เวียดนามใต้ โฮจิมินห์ มุยเน่',
                'desc' => 'ทะเลทรายสองสี รถจี๊ปตะลุยเนินทราย',
                'image' => 'BT-DAD082_VZ_0.jpg',
                'pdf' => 'smile-BT-DAD082_VZ.pdf',
            ],
        ];

       return view('overseas', compact('overseasTours'));
    }
}