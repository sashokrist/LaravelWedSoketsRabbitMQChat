<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent extends Mailable
{
    use Queueable, SerializesModels;

    public string $user;
    public string $message;

    public function __construct(string $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject("New Chat Message from {$this->user}")
                    ->view('emails.chat_message_sent');
    }
}
