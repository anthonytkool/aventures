<?php

namespace App\Mail\Leads;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Lead $lead;
    public string $ref;

   public function __construct(Lead $lead, string $ref, string $tourTitle, int $leadDays = 2)
{
    $this->lead = $lead;
    $this->ref = $ref;
    $this->tourTitle = $tourTitle;
    $this->leadDays = $leadDays;
}

public function build()
{
    $subject = 'New Enquiry ['.$this->ref.'] — '.$this->tourTitle;
    return $this->subject($subject)
        ->replyTo($this->lead->email, $this->lead->name)
        ->view('emails.leads.admin_notification')
        ->with([
            'lead'      => $this->lead,
            'ref'       => $this->ref,
            'tourTitle' => $this->tourTitle,
            'leadDays'  => $this->leadDays,
        ]);
}

}
