<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $details = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        // ✅ ไม่ต้องระบุ Mail::to() เพราะ Mailtrap จับจาก SMTP
        Mail::send(new ContactMail($details));

        return back()->with('success', 'Your message has been sent!');
    }
}
