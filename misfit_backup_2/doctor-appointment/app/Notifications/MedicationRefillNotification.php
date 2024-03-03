<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class MedicationRefillNotification extends Notification
{
    private $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    // public function toMail($notifiable)
    // {
    //     // Define how the notification should be sent via email
    //     return (new MailMessage)
    //         ->line($this->message); // You can customize the email message here
    // }

    // public function toDatabase($notifiable)
    // {
    //     // Define how the notification should be stored in the database
    //     return [
    //         'message' => $this->message, // You can store additional data here
    //     ];
    // }

    public function toArray(object $notifiable) : array
    {
        // Define how the notification should be delivered as an array
        return [
            'message' => $this->message,
        ];
    }

    public function render(): string
    {
        return view('patient.patient_dashboard', [
            'message' => $this->message,
        ]);
    }
}
