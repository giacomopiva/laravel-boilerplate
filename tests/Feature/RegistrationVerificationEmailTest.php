<?php

use App\Models\User;
use ESolution\DBEncryption\Encrypter;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);
});

test('la registrazione invia l\'email di verifica al nuovo utente', function () {
    Notification::fake();

    $response = $this->post('/register', [
        'name' => 'Mario Rossi',
        'email' => 'mario.rossi@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('login'));

    $user = User::where('email', Encrypter::encrypt('mario.rossi@example.com'))->first();

    expect($user)->not->toBeNull();
    expect($user->hasRole('user'))->toBeTrue();
    expect($user->hasVerifiedEmail())->toBeFalse();

    Notification::assertSentTo($user, VerifyEmail::class);
});

test('un utente registrato non verificato non risulta verificato finché non clicca il link', function () {
    Notification::fake();

    $this->post('/register', [
        'name' => 'Anna Bianchi',
        'email' => 'anna.bianchi@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $user = User::where('email', Encrypter::encrypt('anna.bianchi@example.com'))->first();

    expect($user->email_verified_at)->toBeNull();
});
