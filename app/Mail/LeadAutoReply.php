<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadAutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead) {}

    public function build()
    {
        return $this->subject('We received your enquiry – AventureTrip')
            ->markdown('emails.leads.autoreply', ['lead' => $this->lead]);
    }
}
