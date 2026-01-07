<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $email;
    public $password;

    public function __construct($customerName, $email, $password)
    {
        $this->customerName = $customerName;
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Welcome to Desi Delights - Your Account Details')
                    ->view('emails.welcome');
    }
}