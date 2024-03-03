<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerCancel extends Mailable
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
        return $this->subject('Apology from Stygen')->markdown('email.buyer_cancel',[
            'name' => $this->buyer_details['name'],
        ]);
    }
}
