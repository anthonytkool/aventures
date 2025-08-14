<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\Leads\AutoReply;

class LeadController extends Controller
{
    // GET /enquire/{tour:slug}
    public function create(Tour $tour)
    {
        return view('emails.leads.create', compact('tour'));
    }

    // POST /enquire/{tour:slug}
    public function store(Request $request, Tour $tour)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name'  => ['required', 'string', 'max:120'],
            // ถ้ารู้สึกช้า เปลี่ยนเป็น 'email:rfc'
            'email'      => ['required', 'email:rfc,dns'],
            'phone'      => ['nullable', 'string', 'max:60'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'adults'     => ['required', 'integer', 'min:1', 'max:99'],
            'children'   => ['nullable', 'integer', 'min:0', 'max:99'],
            'message'    => ['nullable', 'string', 'max:1200'],
            'website'    => ['nullable', 'size:0'], // honeypot
        ]);

        // เตรียมข้อมูลและบันทึก
        $data['tour_id']  = $tour->id;
        $data['name']     = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
        $data['children'] = $data['children'] ?? 0;

        $lead = Lead::create($data);

        // อ้างอิง
        $ref = 'AT-' . now()->format('ymd') . '-' . $lead->id;
        session()->flash('enquiry_ref', $ref);

        // อีเมลแอดมิน (fallback ถ้า config ไม่มี)
        $adminEmail = config('mail.from.address', 'contact@aventuretrip.com');

        // ป้องกันกรณีไม่มีอีเมลลูกค้า
        if (empty($lead->email)) {
            Log::warning('Lead has no email; skip sending', ['lead_id' => $lead->id, 'ref' => $ref]);
            return redirect()->route('enquiries.thanks');
        }

        try {
            // 1) ส่งถึงลูกค้า
            Mail::to($lead->email)->send(new \App\Mail\Leads\AutoReply($lead, $ref));
            \Log::info('AutoReply sent', ['to' => $lead->email, 'ref' => $ref]);
        } catch (\Throwable $e) {
            \Log::error('AutoReply failed', ['to' => $lead->email, 'ref' => $ref, 'err' => $e->getMessage()]);
        }

        try {
            // 2) แจ้งเตือนถึงแอดมิน (ฉบับคนละฉบับ)
            Mail::to($adminEmail)->send(new \App\Mail\Leads\AdminNotification($lead, $ref));
            \Log::info('AdminNotification sent', ['to' => $adminEmail, 'ref' => $ref]);
        } catch (\Throwable $e) {
            \Log::error('AdminNotification failed', ['to' => $adminEmail, 'ref' => $ref, 'err' => $e->getMessage()]);
        }

        return redirect()->route('enquiries.thanks');
    }

    // GET /enquire/thanks
    public function thanks()
    {
        return view('emails.leads.thanks');
    }
}
