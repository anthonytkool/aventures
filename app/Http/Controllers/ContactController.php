<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use App\Mail\ContactAutoReply;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;



class ContactController extends Controller
{
    public function store(Request $request)
    {
        // กันยิงถี่ ๆ 5 ครั้ง/นาที ต่อ IP (เสริมความปลอดภัย — ถ้าไม่อยากใช้ ลบออกได้)
        $key = 'contact:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'email' => 'Too many submissions, please try again in a minute.',
            ]);
        }
        RateLimiter::hit($key, 60);

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:160'],
            // ลด latency: ใช้ email:rfc (ไม่ทำ DNS lookup)
            'email'   => ['required', 'email:rfc'],
            'phone'   => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'max:2000'],
            'website' => ['nullable', 'size:0'], // honeypot
        ]);

        // สร้าง Ref เพื่อใช้ค้นในกล่องเมล
        $ref = 'CT-' . now()->format('ymd-His') . '-' . substr(str()->uuid()->toString(), 0, 6);

        $admin = config('mail.from.address', 'contact@aventuretrip.com');

       Mail::to($admin)->send(new ContactMessage($data, $ref));
        Mail::to($data['email'])->send(new ContactAutoReply($data, $ref));


        return back()->with('contact_ok', true)->with('contact_ref', $ref);
    }
}
