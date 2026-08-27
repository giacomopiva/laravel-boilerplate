<?php

use App\Mail\ResetPasswordMail;
use App\Models\User;
use ESolution\DBEncryption\Encrypter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);
});

test('richiedere il reset per un\'email registrata invia la mail e salva il token', function () {
    Mail::fake();

    $user = User::factory()->create(['email' => 'utente@example.com']);
    $user->assignRole('user');

    $response = $this->post(route('password.email'), ['email' => 'utente@example.com']);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('password_resets', ['email' => $user->email]);

    Mail::assertSent(ResetPasswordMail::class, function ($mail) {
        return ! empty($mail->token);
    });
});

test('richiedere il reset per un\'email non registrata fallisce la validazione', function () {
    Mail::fake();

    $response = $this->post(route('password.email'), ['email' => 'sconosciuto@example.com']);

    $response->assertSessionHasErrors('email');
    Mail::assertNothingSent();
});

test('un link di reset con token inesistente non genera un errore fatale e reindirizza con un messaggio', function () {
    $response = $this->get(route('password.reset', 'token-che-non-esiste'));

    $response->assertRedirect(route('password.request'));
    $response->assertSessionHas('fail');
});

test('un link di reset con token valido mostra il form di reset', function () {
    $user = User::factory()->create(['email' => 'valido@example.com']);
    $user->assignRole('user');

    DB::table('password_resets')->insert([
        'email' => $user->email,
        'token' => 'token-valido',
        'created_at' => now(),
    ]);

    $response = $this->get(route('password.reset', 'token-valido'));

    $response->assertStatus(200);
    $response->assertViewIs('auth.passwords.reset-password');
});

test('un link di reset con token scaduto viene rifiutato', function () {
    $user = User::factory()->create(['email' => 'scaduto@example.com']);
    $user->assignRole('user');

    DB::table('password_resets')->insert([
        'email' => $user->email,
        'token' => 'token-scaduto',
        'created_at' => now()->subMinutes(config('auth.passwords.users.expire', 60) + 5),
    ]);

    $response = $this->get(route('password.reset', 'token-scaduto'));

    $response->assertRedirect(route('password.request'));
    $response->assertSessionHas('fail');
});

test('inviare una nuova password con un token valido aggiorna la password e consuma il token', function () {
    $user = User::factory()->create([
        'email' => 'reset@example.com',
        'password' => Hash::make('vecchia-password'),
    ]);
    $user->assignRole('user');

    DB::table('password_resets')->insert([
        'email' => $user->email,
        'token' => 'token-reset',
        'created_at' => now(),
    ]);

    $response = $this->post(route('password.update', ['token' => 'token-reset']), [
        'token' => 'token-reset',
        'password' => 'nuova-password',
        'password_confirmation' => 'nuova-password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('message');

    $user->refresh();
    expect(Hash::check('nuova-password', $user->password))->toBeTrue();

    $this->assertDatabaseMissing('password_resets', ['token' => 'token-reset']);

    // La nuova password deve funzionare per il login.
    $loginResponse = $this->post('/login', [
        'email' => 'reset@example.com',
        'password' => 'nuova-password',
    ]);
    $this->assertAuthenticatedAs($user);
});

test('inviare una nuova password con token inesistente non genera errore fatale', function () {
    $response = $this->post(route('password.update', ['token' => 'inesistente']), [
        'token' => 'inesistente',
        'password' => 'nuova-password',
        'password_confirmation' => 'nuova-password',
    ]);

    $response->assertRedirect(route('password.request'));
    $response->assertSessionHas('fail');
});
