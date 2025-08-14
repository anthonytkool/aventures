<?php

namespace App\Mail\Leads;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AutoReply extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $lead
     */
    public function __construct($lead)
    {
        $this->lead = $lead;
        $this->onQueue('mail'); // ส่งเข้า queue 'mail'
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // สร้าง Ref
        $ref = 'AT-' . now()->format('ymd') . '-' . $this->lead->id;

        // WhatsApp link
        $phone     = config('services.whatsapp.phone', '66988361459');
        $tourTitle = optional($this->lead->tour)->title ?: 'a tour';
        $text      = rawurlencode("Hi AventureTrip, my ref is {$ref}. I'm interested in: {$tourTitle}");
        $waUrl     = "https://wa.me/{$phone}?text={$text}";

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->lead->email, $this->lead->name) // ให้ Reply หาอีเมลลูกค้า
            ->subject('Thanks — we received your enquiry ('.$ref.')')
            ->markdown('emails.leads.autoreply')
            ->with([
                'lead' => $this->lead,
                'ref'  => $ref,
                'waUrl'=> $waUrl,
            ]);
    }
}
