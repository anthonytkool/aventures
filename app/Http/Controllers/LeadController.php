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
    // ต้องประกาศก่อนใช้งานใน closure
    $leadDays   = 2;
    $minDate    = now()->addDays($leadDays)->toDateString();

    $data = $request->validate([
        'first_name'  => ['required','string','max:120'],
        'last_name'   => ['required','string','max:120'],
        'nationality' => ['required','string','max:100'],
        'age'         => ['required','integer','min:1','max:120'],
        'email'       => ['required','email:rfc'],
        'phone'       => ['nullable','string','max:60'],
        'start_date'  => ['required','date','after_or_equal:'.$minDate],
        'adults'      => ['required','integer','min:1','max:99'],
        'children'    => ['nullable','integer','min:0','max:99'],
        'message'     => ['nullable','string','max:1200'],
        'website'     => ['nullable','size:0'], // honeypot
    ]);

    // เตรียมข้อมูลบันทึก
    $data['tour_id']  = $tour->id;
    $data['children'] = $data['children'] ?? 0;
    $data['name']     = trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? ''));

    $lead = Lead::create($data);

    $ref       = 'AT-'.now()->format('ymd').'-'.$lead->id;
    $tourTitle = $tour->title ?? $tour->name ?? $tour->slug;

    // ประกาศ EMAIL แอดมินก่อนใช้ใน closure
    $adminEmail = env('MAIL_ADMIN_TO', config('mail.from.address', 'contact@aventuretrip.com'));

    // ส่งอีเมลลูกค้าทันที (ไม่ใช่ใน closure)
    try {
        Mail::to($lead->email)->send(new AutoReply($lead, $ref, $tourTitle, $leadDays));
    } catch (\Throwable $e) {
        \Log::error('Customer auto-reply failed', ['lead_id'=>$lead->id, 'error'=>$e->getMessage()]);
    }

    // ส่งอีเมลแอดมินหลัง response ออก (ต้องใส่ตัวแปรใน use)
    app()->terminating(function () use ($adminEmail, $lead, $ref, $tourTitle, $leadDays) {
        try {
            Mail::to($adminEmail)->send(new AdminNotification($lead, $ref, $tourTitle, $leadDays));
        } catch (\Throwable $e) {
            \Log::error('Admin notification failed', ['lead_id'=>$lead->id, 'error'=>$e->getMessage()]);
        }
    });

    session()->flash('enquiry_ref', $ref);
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
