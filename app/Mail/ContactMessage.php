<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public array $data, public string $ref)
    {
        $this->onQueue('mail');
    }

    public function build()
    {
        $subject = '[Contact '.$this->ref.'] Message from '.$this->data['name'];

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->data['email'], $this->data['name'])
            ->subject($subject)
            ->markdown('emails.contact.message')
            ->with(['data' => $this->data, 'ref' => $this->ref]);
    }
}
