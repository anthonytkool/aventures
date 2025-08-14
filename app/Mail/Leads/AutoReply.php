<?php

namespace App\Mail\Leads;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AutoReply extends Mailable
{
    use Queueable, SerializesModels;

   public function __construct(Lead $lead, string $ref, string $tourTitle, int $leadDays = 2)
{
    $this->lead = $lead;
    $this->ref = $ref;
    $this->tourTitle = $tourTitle;
    $this->leadDays = $leadDays;
}

public function build()
{
    $subject = 'We received your enquiry ['.$this->ref.'] — '.$this->tourTitle;
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
