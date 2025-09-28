<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class redemption extends Mailable
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
        return $this->markdown('emails.redemption')
        ->subject('Redemption Request')
        ->with([
            'username' => $this->data['username'],
            'email' => $this->data['email'],
            'amount' => $this->data['amount'],
            'ticket' => $this->data['ticket'],
            'url' => env("APP_URL")."/login",
        ]);
    }
}
