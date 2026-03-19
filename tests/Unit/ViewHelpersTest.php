<?php

use Illuminate\Support\Facades\Route;

test('appSectionName restituisce il primo segmento dell\'URL', function () {
    $this->get('/admin/user');

    expect(appSectionName(0))->toBe('admin');
});

test('appSectionName restituisce il secondo segmento dell\'URL', function () {
    $this->get('/admin/user');

    expect(appSectionName(1))->toBe('user');
});

test('appSectionName restituisce il segmento corretto per URL a un livello', function () {
    $this->get('/admin');

    expect(appSectionName(0))->toBe('admin');
});

test('isSectionActive restituisce true quando la sezione è attiva', function () {
    Route::get('/admin/user', fn () => 'ok');
    $this->get('/admin/user');

    expect(isSectionActive(['admin'], 0))->toBeTrue();
});

test('isSectionActive restituisce false quando la sezione non corrisponde', function () {
    Route::get('/admin/user', fn () => 'ok');
    $this->get('/admin/user');

    expect(isSectionActive(['dashboard'], 0))->toBeFalse();
});

test('isSectionActive restituisce true per corrispondenza parziale', function () {
    Route::get('/admin/user', fn () => 'ok');
    $this->get('/admin/user');

    expect(isSectionActive(['adm'], 0))->toBeTrue();
});

test('isSectionActive verifica lista multipla di sezioni', function () {
    Route::get('/admin/user', fn () => 'ok');
    $this->get('/admin/user');

    expect(isSectionActive(['dashboard', 'admin', 'settings'], 0))->toBeTrue();
});
