<?php

namespace App\Mail\Leads;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;

    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    public function build()
    {
        $ref   = 'AT-' . now()->format('ymd') . '-' . $this->lead->id;
        $phone = config('services.whatsapp.phone', '66988361459');

        $tourTitle = optional($this->lead->tour)->title ?: 'a tour';
        $text  = rawurlencode("Hi AventureTrip, my ref is {$ref}. I'm interested in: {$tourTitle}");
        $waUrl = "https://wa.me/{$phone}?text={$text}";

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->lead->email, $this->lead->name) // กด Reply ตอบหาลูกค้า
            ->subject('Thanks — we received your enquiry ('.$ref.')')
            ->markdown('emails.leads.autoreply')
            ->with([
                'lead' => $this->lead,
                'ref'  => $ref,
                'waUrl'=> $waUrl,
            ]);
    }
}
