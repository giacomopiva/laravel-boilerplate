<?php

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);
});

test('storeUser crea un nuovo utente con password hashata', function () {
    $service = new UserService;

    $user = $service->storeUser([
        'name' => 'Mario Rossi',
        'email' => 'mario@example.com',
        'password' => 'password123',
    ]);

    expect($user)->toBeInstanceOf(User::class);
    expect($user->id)->not->toBeNull();
    expect(\Illuminate\Support\Facades\Hash::check('password123', $user->password))->toBeTrue();
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});

test('updateUser aggiorna i dati dell\'utente', function () {
    $service = new UserService;
    $user = User::factory()->create(['name' => 'Nome Originale']);

    $service->updateUser($user, [
        'name' => 'Nome Aggiornato',
        'email' => 'updated@example.com',
        'status' => true,
    ]);

    $user->refresh();
    expect($user->name)->toBe('Nome Aggiornato');
});

test('updateUser aggiorna la password se fornita', function () {
    $service = new UserService;
    $user = User::factory()->create();

    $service->updateUser($user, [
        'name' => $user->name,
        'email' => $user->email,
        'status' => true,
        'password' => 'nuovapassword',
    ]);

    $user->refresh();
    expect(\Illuminate\Support\Facades\Hash::check('nuovapassword', $user->password))->toBeTrue();
});

test('updateUser non cambia la password se stringa vuota', function () {
    $service = new UserService;
    $user = User::factory()->create(['password' => \Illuminate\Support\Facades\Hash::make('originale')]);
    $originalHash = $user->password;

    $service->updateUser($user, [
        'name' => $user->name,
        'email' => $user->email,
        'status' => true,
        'password' => '',
    ]);

    $user->refresh();
    expect($user->password)->toBe($originalHash);
});

test('deleteUser elimina l\'utente e restituisce JSON di successo', function () {
    $service = new UserService;
    $user = User::factory()->create();
    $userId = $user->id;

    $response = $service->deleteUser($user);

    expect($response->getStatusCode())->toBe(200);
    $data = json_decode($response->getContent(), true);
    expect($data['success'])->toBeTrue();
    expect($data['message'])->toBe('Utente eliminato con successo');
    $this->assertDatabaseMissing('users', ['id' => $userId]);
});

test('assignRoleToUser assegna il ruolo admin', function () {
    $service = new UserService;
    $user = User::factory()->create();

    $service->assignRoleToUser($user, 'admin');

    expect($user->hasRole('admin'))->toBeTrue();
});

test('assignRoleToUser assegna il ruolo user', function () {
    $service = new UserService;
    $user = User::factory()->create();

    $service->assignRoleToUser($user, 'user');

    expect($user->hasRole('user'))->toBeTrue();
});

test('assignRoleToUser non lancia eccezione per ruolo inesistente', function () {
    $service = new UserService;
    $user = User::factory()->create();

    $service->assignRoleToUser($user, 'ruolo-inesistente');

    expect($user->roles)->toBeEmpty();
});
