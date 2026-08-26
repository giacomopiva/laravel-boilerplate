<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);
});

test('il link di verifica email firmato reindirizza nell\'area dell\'utente, non va in 500', function () {
    Event::fake();

    $user = User::factory()->create([
        'email' => 'daverificare@example.com',
        'password' => Hash::make('password'),
        'status' => true,
        'email_verified_at' => null,
    ]);
    $user->assignRole('user');

    $url = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $response = $this->actingAs($user)->get($url);

    $response->assertRedirect(route('user.home'));
    Event::assertDispatched(Verified::class);
});

test('la rotta di conferma password, da utente autenticato, risponde senza errore fatale', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
        'status' => true,
    ]);
    $user->assignRole('user');

    $response = $this->actingAs($user)->get(route('password.confirm'));

    $response->assertStatus(200);
});
