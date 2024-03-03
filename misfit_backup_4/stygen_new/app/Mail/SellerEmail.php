<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $seller_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seller_details)
    {
        $this->seller_details = $seller_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation')
        ->view('email.seller_email');
    }
}
