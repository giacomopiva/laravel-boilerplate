<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        // Il contenuto dell'email è personalizzato in App\Models\User::sendEmailVerificationNotification()
        // (usa App\Notifications\VerifyEmailNotification, brandizzata come il reset password).
        Event::listen(Registered::class, SendEmailVerificationNotification::class);
    }
}
