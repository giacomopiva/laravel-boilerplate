<?php

namespace App\Notifications;

use App\Mail\VerifyEmailMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Mail\Mailable;

class VerifyEmailNotification extends VerifyEmail
{
    /**
     * Usa il Mailable brandizzato del progetto invece del MailMessage
     * generico di Laravel, per uniformare lo stile a "Reset della password".
     */
    public function toMail($notifiable): Mailable
    {
        $url = $this->verificationUrl($notifiable);

        return (new VerifyEmailMail($url, $notifiable->name))
            ->to($notifiable->getEmailForVerification());
    }
}
