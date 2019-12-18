<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    public function __construct($details)
    {
        return $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Mail from 1760034')
            ->view('emails.details');
    }
}
