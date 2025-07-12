<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Jobs\NotifyChatUser;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatMessageSent;


class ChatController extends Controller
{
    public function send(Request $request)
    {
        $message = [
            'user' => 'User-' . rand(1, 999),
            'message' => $request->message,
        ];

        broadcast(new MessageSent($message))->toOthers();

         Mail::to('admin@example.com')->queue(new ChatMessageSent($message['user'], $message['message']));

    // Dispatch RabbitMQ job
    NotifyChatUser::dispatch("User sent message: {$message['message']}");

        return ['status' => 'Message Sent!'];
    }
}
