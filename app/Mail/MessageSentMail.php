<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject('New Chat Message')
                    ->view('emails.message-sent');
    }
}

