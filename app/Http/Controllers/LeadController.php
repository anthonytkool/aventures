<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Leads\AdminNotification;
use App\Mail\Leads\AutoReply;

class LeadController extends Controller
{
    // GET /enquire/{tour:slug}
    public function create(Tour $tour)
    {
        // Lead time (days) — ปรับเลขเดียวได้
        $leadDays = 2;
        $minDate  = now()->addDays($leadDays)->toDateString();

        return view('emails.leads.create', compact('tour', 'leadDays', 'minDate'));
    }

    // POST /enquire/{tour:slug}
    public function store(Request $request, Tour $tour)
    {
        // ใช้ lead time เดียวกับหน้า form
        $leadDays = 2;
        $minDate  = now()->addDays($leadDays)->toDateString();

        // Validation (คง flow เดิม)
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name'  => ['required', 'string', 'max:120'],
            'email'      => ['required', 'email:rfc'], // ตัด dns เพื่อลดดีเลย์เล็กน้อย
            'phone'      => ['nullable', 'string', 'max:60'],
            'start_date' => ['required', 'date', 'after_or_equal:' . $minDate],
            'adults'     => ['required', 'integer', 'min:1', 'max:99'],
            'children'   => ['nullable', 'integer', 'min:0', 'max:99'],
            'message'    => ['nullable', 'string', 'max:1200'],
            'website'    => ['nullable', 'size:0'], // honeypot
        ]);

        // Normalize + save
        $data['tour_id']  = $tour->id;
        $data['name']     = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
        $data['children'] = $data['children'] ?? 0;

        $lead = Lead::create($data);

        // Reference สำหรับแสดง/อีเมล
        $ref = 'AT-' . now()->format('ymd') . '-' . $lead->id;
        session()->flash('enquiry_ref', $ref);

        $adminEmail = env('MAIL_ADMIN_TO', config('mail.from.address', 'contact@aventuretrip.com'));
        $tourTitle  = $tour->title ?? $tour->name ?? $tour->slug;

        /**
         * กลยุทธ์เร่งความรู้สึกเร็วของลูกค้า:
         * 1) ส่ง AutoReply ให้ลูกค้าก่อน (sync)
         * 2) redirect ไปหน้า Thanks ทันที
         * 3) ใช้ app()->terminating(...) ส่งเมล Admin ต่อ "หลังจาก" response ออกแล้ว
         *    - ไม่ใช่คิว, ไม่แตะ driver, ไม่เปลี่ยน SMTP
         */

        // (1) ส่ง AutoReply ถึงลูกค้า — ก่อน
        $tic = microtime(true);
        try {
            Mail::to($lead->email)->send(new AutoReply($lead, $ref, $tourTitle, $leadDays));
            \Log::info('Customer auto-reply sent', [
                'lead_id' => $lead->id,
                'ref'     => $ref,
                'ms'      => round((microtime(true) - $tic) * 1000),
            ]);
        } catch (\Throwable $e) {
            \Log::error('Customer auto-reply failed', [
                'lead_id' => $lead->id,
                'ref'     => $ref,
                'to'      => $lead->email,
                'error'   => $e->getMessage(),
            ]);
        }

        // (2) จองงานส่งเมล Admin ให้ทำ "หลัง" ส่ง response แล้ว
        app()->terminating(function () use ($adminEmail, $lead, $ref, $tourTitle, $leadDays) {
            $tic = microtime(true);
            try {
                Mail::to($adminEmail)->send(new AdminNotification($lead, $ref, $tourTitle, $leadDays));
                \Log::info('Admin notification sent (terminating)', [
                    'lead_id' => $lead->id,
                    'ref'     => $ref,
                    'ms'      => round((microtime(true) - $tic) * 1000),
                ]);
            } catch (\Throwable $e) {
                \Log::error('Admin notification failed (terminating)', [
                    'lead_id' => $lead->id,
                    'ref'     => $ref,
                    'to'      => $adminEmail,
                    'error'   => $e->getMessage(),
                ]);
            }
        });

        // (3) ลูกค้าไปหน้า Thanks ทันที
        return redirect()->route('enquiries.thanks');
    }

    // GET /enquire/thanks
    public function thanks()
    {
        $ref = session('enquiry_ref');
        if (empty($ref)) {
            return redirect()->route('tours.index');
        }
        return view('emails.leads.thanks', compact('ref'));
    }
}
