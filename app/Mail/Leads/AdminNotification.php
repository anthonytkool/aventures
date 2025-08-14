<?php

namespace App\Mail\Leads;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Lead $lead;
    public string $ref;

    public function __construct(Lead $lead, string $ref = '')
    {
        $this->lead = $lead;
        $this->ref  = $ref;
    }

    public function build()
    {
        $tourTitle = optional($this->lead->tour)->title ?: 'Unknown tour';

        // แนะนำให้ใส่ Ref ลงใน subject เพื่อค้นหาในกล่องเมลได้ง่าย
        $subject   = 'New enquiry'
                   . ($this->lead->id ? ' #'.$this->lead->id : '')
                   . ' · ' . $tourTitle
                   . ($this->ref ? ' ('.$this->ref.')' : '');

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->lead->email, $this->lead->name)
            ->subject($subject)
            ->markdown('emails.leads.notification')
            ->with([
                'lead' => $this->lead,
                'ref'  => $this->ref,
            ]);
    }
}
