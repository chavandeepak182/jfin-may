<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanNotificationMail extends Mailable
{
    public $title;
    public $body; // ✅ changed

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function build()
    {
        return $this->subject($this->title)
                    ->view('emails.notification');
    }
}
