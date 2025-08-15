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
        $subject = "We received your enquiry [{$this->ref}] — {$this->tourTitle}";

        return $this->subject($subject)
            ->view('emails.leads.auto_reply')
            ->with([
                'lead'      => $this->lead,
                'ref'       => $this->ref,
                'tourTitle' => $this->tourTitle,
                'leadDays'  => $this->leadDays,
            ]);
    }
}
