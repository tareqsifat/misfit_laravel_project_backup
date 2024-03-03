<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $buyer_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($buyer_details)
    {
        $this->buyer_details = $buyer_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank you for shopping with us')
        ->view('email.review_mail');
    }
}
