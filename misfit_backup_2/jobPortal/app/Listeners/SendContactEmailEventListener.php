<?php

namespace App\Listeners;

use App\Events\SendContactEmailEvent;
use App\Mail\SendContactMail;
use Illuminate\Support\Facades\Mail;

class SendContactEmailEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendContactEmailEvent $event)
    {
        $mailData = [
            "name" => $event->name,
            "email" => $event->email,
            "message" => $event->message
        ];

        // Use the Mail facade directly, no need for dispatch here
        Mail::to(env('EMAIL_SEND_TO'))
            ->cc(env('TEST_EMAIL'))
            ->send(new SendContactMail($mailData));
        // event(new ActivityLogEvent('dashboard', json_encode($mailData), "Sent email for ICT Service", 'ict_services'));
    }
}
