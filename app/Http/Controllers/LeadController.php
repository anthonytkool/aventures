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
        return view('emails.leads.create', compact('tour'));
    }

    // POST /enquire/{tour:slug}
    public function store(Request $request, Tour $tour)
    {
        // validate (ถ้า dev ช้า ให้ลด 'email:rfc,dns' → 'email:rfc' หรือ 'email')
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name'  => ['required', 'string', 'max:120'],
            'email'      => ['required', 'email:rfc,dns'],
            'phone'      => ['nullable', 'string', 'max:60'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'adults'     => ['required', 'integer', 'min:1', 'max:99'],
            'children'   => ['nullable', 'integer', 'min:0', 'max:99'],
            'message'    => ['nullable', 'string', 'max:1200'],
            'website'    => ['nullable', 'size:0'], // honeypot
        ]);

        $data['tour_id']  = $tour->id;
        $data['name']     = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
        $data['children'] = $data['children'] ?? 0;

        $lead = Lead::create($data);

        // รหัสอ้างอิง (โชว์หน้า Thank you / ใส่หัวเรื่องเมล)
        $ref = 'AT-' . now()->format('ymd') . '-' . $lead->id;
        session()->flash('enquiry_ref', $ref);

        // คิวเมล (หลัง commit) — เร็วที่หน้าเว็บ, ส่งจริงที่ worker
        $admin = config('mail.from.address', 'contact@aventuretrip.com');

        Mail::to($admin)->queue(
            (new AdminNotification($lead, $ref))
                ->onQueue('mail')
                ->afterCommit()
        );

        Mail::to($lead->email)->queue(
            (new AutoReply($lead, $ref))
                ->onQueue('mail')
                ->delay(now()->addSeconds(2))
                ->afterCommit()
        );

        return redirect()->route('enquiries.thanks');
    }

    // GET /enquire/thanks
    public function thanks()
    {
        return view('emails.leads.thanks');
    }
}
