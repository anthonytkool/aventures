<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * แสดงฟอร์มติดต่อ (GET)
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * รับข้อมูลฟอร์ม ส่งอีเมล และ redirect กลับพร้อมข้อความสำเร็จ (POST)
     */
    public function send(Request $request)
    {
        // ตรวจสอบข้อมูล
        $data = $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required',
        ]);

        // ส่งเมลไปยังแอดมิน (เปลี่ยน email ได้ตามต้องการ)
        Mail::to('contact@aventuretrip.com')
            ->send(new ContactMail($data));

        // กลับหน้าฟอร์มพร้อม flash message
        return back()->with('success', 'ส่งข้อความสำเร็จแล้วครับ');
    }
}