<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreditUserMail extends Mailable
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
        return $this->markdown('emails.credit-user')
        ->subject($this->data['subject'])
        ->with([
            'username' => $this->data['username'],
            'email' => $this->data['email'],
            'amount' => $this->data['amount'],
            'description' => $this->data['description'],
            'url' => env("APP_URL")."/login",
        ]);
    }
}
