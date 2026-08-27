<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Il progetto non usa EventServiceProvider (Laravel 11+/bootstrap/app.php):
        // la registrazione del listener che invia l'email di verifica va fatta qui.
        Event::listen(Registered::class, SendEmailVerificationNotification::class);

        // Personalizza il contenuto dell'email di verifica account, mantenendo
        // il template Markdown nativo di Laravel (affidabile nei client email).
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifica il tuo indirizzo email — '.config('app.name'))
                ->greeting('Ciao '.$notifiable->name.'!')
                ->line('Grazie per esserti registrato su '.config('app.name').'. Conferma il tuo indirizzo email per attivare l\'account.')
                ->action('Verifica email', $url)
                ->line('Se non hai creato tu questo account, puoi ignorare questa email.');
        });
    }
}
