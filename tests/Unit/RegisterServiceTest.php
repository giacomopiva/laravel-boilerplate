<?php

use App\Models\User;
use App\Services\RegisterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);
});

test('storeUser crea utente con i dati corretti', function () {
    $service = new RegisterService;

    $user = $service->storeUser([
        'name' => 'Luigi Verdi',
        'email' => 'luigi@example.com',
        'password' => 'password123',
    ]);

    expect($user)->toBeInstanceOf(User::class);
    expect($user->id)->not->toBeNull();
    expect(\Illuminate\Support\Facades\Hash::check('password123', $user->password))->toBeTrue();
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});

test('assignRoleToUser assegna il ruolo user per default', function () {
    $service = new RegisterService;
    $user = User::factory()->create();

    $service->assignRoleToUser($user);

    expect($user->hasRole('user'))->toBeTrue();
    expect($user->hasRole('admin'))->toBeFalse();
});

test('assignRoleToUser assegna il ruolo specificato', function () {
    $service = new RegisterService;
    $user = User::factory()->create();

    $service->assignRoleToUser($user, 'admin');

    expect($user->hasRole('admin'))->toBeTrue();
});

test('storeUser nuovo utente ha status attivo per default', function () {
    $service = new RegisterService;

    $user = $service->storeUser([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $user->refresh();
    expect($user->status)->toBeTrue();
});
