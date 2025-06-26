<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resetUrl;
    public $expire;

    public function __construct($user, $resetUrl)
    {
        $this->user = $user;
        $this->resetUrl = $resetUrl;
        $this->expire = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
    }

    public function build()
    {
        return $this->subject('Reset Your Password - ' . config('app.name'))
                    ->view('emails.reset-password');
    }
}
