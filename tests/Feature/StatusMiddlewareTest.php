<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);

    // Rotta di test protetta dallo StatusMiddleware
    Route::middleware(['web', 'auth', \App\Http\Middleware\StatusMiddleware::class])
        ->get('/test-status-route', fn () => response('OK', 200));
});

test('utente attivo può accedere alle rotte protette', function () {
    $user = User::factory()->create(['status' => true]);
    $this->actingAs($user);

    $response = $this->get('/test-status-route');

    $response->assertStatus(200);
    $response->assertSee('OK');
});

test('utente disabilitato viene disconnesso e reindirizzato al login', function () {
    $user = User::factory()->create(['status' => false]);
    $this->actingAs($user);

    $response = $this->get('/test-status-route');

    $response->assertRedirect('login');
    $this->assertGuest();
});

test('utente disabilitato riceve messaggio di errore', function () {
    $user = User::factory()->create(['status' => false]);
    $this->actingAs($user);

    $response = $this->get('/test-status-route');
    $response->assertSessionHasErrors('disabled');
});

test('utente non autenticato viene reindirizzato al login senza errori di status', function () {
    $response = $this->get('/test-status-route');

    $response->assertRedirect();
    $this->assertGuest();
});
