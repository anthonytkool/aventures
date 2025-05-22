<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * สร้าง instance พร้อมข้อมูลจากฟอร์ม
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * กำหนด view และ subject ของอีเมล
     */
    public function build()
    {
        return $this
            ->subject('New Contact Message')
            ->view('emails.contact')
            ->with('details', $this->details);
    }
}
