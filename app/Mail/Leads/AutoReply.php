<?php

namespace App\Mail\Leads;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $lead, public string $ref)
    {
        // ไม่เข้าคิว
    }

    public function build()
    {
        $phone = config('services.whatsapp.phone', '66988361459');

        $tourTitle = optional($this->lead->tour)->title ?: 'a tour';
        $text  = rawurlencode("Hi AventureTrip, my ref is {$this->ref}. I'm interested in: {$tourTitle}");
        $waUrl = "https://wa.me/{$phone}?text={$text}";

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->lead->email, $this->lead->name)
            ->subject('Thanks — we received your enquiry ('.$this->ref.')')
            ->markdown('emails.leads.autoreply')
            ->with([
                'lead' => $this->lead,
                'ref'  => $this->ref,
                'waUrl'=> $waUrl,
            ]);
    }
}
