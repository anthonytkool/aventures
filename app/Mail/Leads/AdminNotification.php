<?php

namespace App\Mail\Leads;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotification extends Mailable
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
        $subject = "New Enquiry [{$this->ref}] — {$this->tourTitle}";

        return $this->subject($subject)
            // optionally make replies go straight to the customer:
            ->replyTo($this->lead->email, $this->lead->name ?? null)
            ->view('emails.leads.admin_notification')
            ->with([
                'lead'        => $this->lead,
                'ref'         => $this->ref,
                'tourTitle'   => $this->tourTitle,
                'leadDays'    => $this->leadDays,
                // if your templates show them:
                'nationality' => $this->lead->nationality ?? null,
                'age'         => $this->lead->age ?? null,
            ]);
    }
}
