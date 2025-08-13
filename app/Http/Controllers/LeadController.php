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
        $data = $request->validate([
            'first_name' => ['required','string','max:120'],
            'last_name'  => ['required','string','max:120'],
            'email'      => ['required','email:rfc,dns'],
            'phone'      => ['nullable','string','max:60'],
            'start_date' => ['required','date','after_or_equal:today'],
            'adults'     => ['required','integer','min:1','max:99'],
            'children'   => ['nullable','integer','min:0','max:99'],
            'message'    => ['nullable','string','max:1200'],
            // honeypot
            'website'    => ['nullable','size:0'],
        ]);

        // ผูกทัวร์ + รวมชื่อเต็ม + กัน children ว่าง
        $data['tour_id']  = $tour->id;
        $data['name']     = trim(($data['first_name'] ?? '').' '.($data['last_name'] ?? ''));
        $data['children'] = $data['children'] ?? 0;

        $lead = Lead::create($data);

        // รหัสอ้างอิง (โชว์หน้า Thank you / ใส่หัวเรื่องเมล)
        $ref = 'AT-'.now()->format('ymd').'-'.$lead->id;
        session()->flash('enquiry_ref', $ref);

        // ส่งเมล (กันพังด้วย try/catch)
        try {
            Mail::to(config('mail.from.address'))
                ->send(new AdminNotification($lead, $ref));

            Mail::to($lead->email)
                ->send(new AutoReply($lead, $ref));
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->route('enquiries.thanks');
    }

    // GET /enquire/thanks
    public function thanks()
    {
        return view('emails.leads.thanks');
    }
}
