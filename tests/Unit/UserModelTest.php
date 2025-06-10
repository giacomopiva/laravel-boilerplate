<?php

use App\Models\User;

test('getRoles returns available roles', function () {
    expect(User::getRoles())->toBe([
        'admin' => 'Amministratore',
        'user' => 'Utente',
    ]);
});

test('getStatuses returns available statuses', function () {
    expect(User::getStatuses())->toBe([
        1 => 'Attivo',
        0 => 'Disattivo',
    ]);
});

