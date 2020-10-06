<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Crypt;


class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // generate link
        $encryptedEmail = Crypt::encrypt($this->user->email);
        //
        
        $link = route('signup.verify', ['token' => $encryptedEmail]);

        return $this->subject('Verifikasi Alamat Email Anda')
            ->with('link', $link)
            ->view('email.verify');
    }
}
