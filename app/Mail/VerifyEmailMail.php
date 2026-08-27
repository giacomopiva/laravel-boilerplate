<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $url, public string $name)
    {
        //
    }

    public function build(): self
    {
        return $this
            ->subject('Verifica il tuo indirizzo email — '.config('app.name'))
            ->view('emails.verify-email', [
                'url' => $this->url,
                'name' => $this->name,
            ]);
    }
}
