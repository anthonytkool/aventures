<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * แสดงหน้าฟอร์ม Contact
     */
    public function show()
    {
        return view('contact'); // หรือชื่อ view ของคุณ
    }

    /**
     * รับข้อมูล ส่งอีเมล และ redirect กลับพร้อมข้อความสำเร็จ
     */
    public function send(Request $request)
    {
        // ตรวจสอบข้อมูล
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        // เตรียมรายละเอียดที่จะส่ง
        $details = $request->only('name', 'email', 'message');

        // ส่งเมล
        Mail::to('contact@aventuretrip.com')
            ->send(new ContactMail($details));

        // กลับหน้าฟอร์มพร้อม flash message
        return back()->with('success', 'ส่งข้อความสำเร็จแล้วครับ');
    }
}
