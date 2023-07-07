<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $dynamicData;

    public function __construct($dynamicData, $subject)
    {
        $this->dynamicData = $dynamicData;
        $this->subject($subject);
    }
    public function build()
    {

        return $this->view('emails.send');
    }

    public function attachments(): array
    {
        return [];
    }
}
