<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $otp;

    /**  
     * Create a new message instance.
     *
     * @param string $email
     */
    public function __construct($email,$otp)
    {
        $this->email = $email;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('passwordemail') // Ensure the view path is correct
                    ->with([
                        'email' => $this->email,
                        'otp' => $this->otp
                    ])
                    ->subject('Password Reset Request');
    }
}