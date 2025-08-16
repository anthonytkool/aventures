<?php

namespace App\Mail\Leads;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Lead $lead,
        public string $ref,
        public string $tourTitle,
        public int $leadDays = 2
    ) {}

    public function build()
{
    $subject = "Thank you — we received your enquiry ({$this->ref})";

    return $this->subject($subject)
        ->from(config('mail.from.address'), config('mail.from.name')) // เหมือนหน้า Contact
        ->replyTo(config('mail.from.address'), config('mail.from.name')) // หรือ $adminEmail ถ้าต้องการ
        ->markdown('emails.leads.autoreply')  // << ใช้ markdown (ไม่ใช่ view)
        ->with([
            'lead'       => $this->lead,
            'ref'        => $this->ref,
            'tourTitle'  => $this->tourTitle,
            'leadDays'   => $this->leadDays,
            'nationality'=> $this->lead->nationality ?? null,
            'age'        => $this->lead->age ?? null,
        ]);
}

}
