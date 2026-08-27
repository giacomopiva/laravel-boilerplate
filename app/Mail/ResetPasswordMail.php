<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $token)
    {
        //
    }

    public function build(): self
    {
        return $this
            ->subject('Reset della password — '.config('app.name'))
            ->view('emails.reset-password', [
                'token' => $this->token,
            ]);
    }
}
