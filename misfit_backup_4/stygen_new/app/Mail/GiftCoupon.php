<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GiftCoupon extends Mailable
{
    use Queueable, SerializesModels;

    public $user_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_details)
    {
        $this->user_details = $user_details;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your gift voucher from stygen')->markdown('email.gift', [
            'code' => $this->user_details['coupon'],
            'name' => $this->user_details['name'],
            'amount' => $this->user_details['amount']
        ]);
    }
}
