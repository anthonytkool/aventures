<?php

namespace App\Mail\Leads;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;   // <— เพิ่มบรรทัดนี้
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotification extends Mailable implements ShouldQueue  // <— implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Lead $lead;
    public string $ref;

    // ปรับค่า retry / backoff ได้ตามต้องการ
    public int $tries = 3;
    public int $backoff = 30;

    public function __construct(Lead $lead, string $ref = '')
    {
        $this->lead = $lead;
        $this->ref  = $ref;
    }

    public function build()
    {
        $tourTitle = optional($this->lead->tour)->title ?: 'Unknown tour';
        $subject   = 'New enquiry'
                   . ($this->lead->id ? ' #'.$this->lead->id : '')
                   . ' · '.$tourTitle;

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
