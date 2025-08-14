<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data, public string $ref)
    {
        // ไม่เข้าคิว
    }

    public function build()
    {
        $subject = 'Thanks — we received your message ('.$this->ref.')';

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject($subject)
            ->markdown('emails.contact.autoreply')
            ->with([
                'data' => $this->data,
                'ref'  => $this->ref,
            ]);
    }
}
