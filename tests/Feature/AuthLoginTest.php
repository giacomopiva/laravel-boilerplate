<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);
});

test('la pagina di login è accessibile', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('login con credenziali errate reindirizza con errore', function () {
    $response = $this->post('/login', [
        'email' => 'inesistente@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertRedirect('login');
    $this->assertGuest();
});

test('login richiede email', function () {
    $response = $this->post('/login', [
        'email' => '',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
});

test('login richiede password', function () {
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => '',
    ]);

    $response->assertSessionHasErrors('password');
});

test('utente admin viene reindirizzato a /admin/home dopo il login', function () {
    $user = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'status' => true,
    ]);
    $user->assignRole('admin');

    $response = $this->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect('/admin/home');
    $this->assertAuthenticatedAs($user);
});

test('utente user viene reindirizzato a /user/home dopo il login', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('password'),
        'status' => true,
    ]);
    $user->assignRole('user');

    $response = $this->post('/login', [
        'email' => 'user@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect('/user/home');
    $this->assertAuthenticatedAs($user);
});

test('il campo last_login viene aggiornato al login', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'status' => true,
        'last_login' => null,
    ]);
    $user->assignRole('user');

    $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $user->refresh();
    expect($user->last_login)->not->toBeNull();
});

test('logout disconnette l\'utente', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/logout');

    $this->assertGuest();
});
