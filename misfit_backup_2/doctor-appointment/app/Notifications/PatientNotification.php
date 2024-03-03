<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PatientMedicationRefillNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The medication that needs to be refilled.
     *
     * @var \App\Models\Prescription
     */
    public $prescription;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Prescription $prescription
     * @return void
     */
    public function __construct(\App\Models\Prescription $prescription)
    {
        $this->prescription = $prescription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;

        $message->subject('Medication refill notification');

        $message->line('You have a medication that needs to be refilled:');
        $message->line($this->prescription->medication->name);
        $message->line('');
        $message->line('You have a medication that needs to be refilled:');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'prescription_id' => $this->prescription->id,
            'medication_name' => $this->prescription->medication->name,
        ];
    }
}
