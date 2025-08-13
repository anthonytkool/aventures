<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead) {}

    public function build()
    {
        return $this->subject('New tour enquiry: '.$this->lead->tour->title)
            ->markdown('emails.leads.notification', ['lead' => $this->lead]);
    }
}
