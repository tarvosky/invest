<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class supportEmailToAdmin extends Mailable
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

        return $this->markdown('emails.supportadmin')
        ->subject('Support Ticket '. $this->data['ticket'])
        ->with([
            'subject' => $this->data['subject'],
            'ticket' => $this->data['ticket'],
            'username' => $this->data['username'],
            'comment' => $this->data['comment'],
            'email' => $this->data['email'],
            'url' => env("APP_URL")."/login",
        ]);
    }
}
