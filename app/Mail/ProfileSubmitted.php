<?php

namespace App\Mail;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProfileSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public $profile;

    public function __construct(User $user, Profile $profile)
    {
        $this->user = $user;
        $this->profile = $profile;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject("New profile submission — user #{$this->user->id}")
            ->markdown('emails.profiles.submitted')
            ->with([
                'user' => $this->user,
                'profile' => $this->profile,
            ]);

        // Attach files if they exist
        if ($this->profile->id_front_path && Storage::exists($this->profile->id_front_path)) {
            $mail->attach(Storage::path($this->profile->id_front_path));
        }
        if ($this->profile->id_back_path && Storage::exists($this->profile->id_back_path)) {
            $mail->attach(Storage::path($this->profile->id_back_path));
        }

        return $mail;
    }
}
