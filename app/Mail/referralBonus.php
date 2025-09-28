<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class referralBonus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($v)
    {
        $this->data = $v;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.referral_bonus')
        ->subject('Referral Bonus')
        ->with([
            'amount' => $this->data['amount'],
            'username' => $this->data['username'],
            'ref_username' => $this->data['ref_username'],
            'url' => env("APP_URL")."/login",
        ]);
    }
}
