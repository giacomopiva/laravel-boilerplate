<?php

use Illuminate\Support\Facades\Route;

/**
 * Rotte utente non autenticato
 */
Route::get('/', function () {
    return view('flex-home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});

/**
 * Rotte per il blog (FlexStart) — contenuto statico, link fissi, nessuna tabella dati
 */
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog');

Route::get('/blog/articolo', function () {
    return view('blog.show');
})->name('blog.show');

/**
 * Rotte per l'autenticazione
 * 
 * Per abilitare il reset della password, impostare il valore 'reset' a true
 * Per abilitare la registrazione di un nuovo utente, impostare il valore 'register' a true
 * Per abilitate la conferma della registrazione, impostare il valore 'confirm' a true ??? 
 * Per abilitare la verifica dell'email, impostare il valore 'verify' a true ??? 
 * 
 * I template sono: 
 * resources/views/admin/user/email/account-confirmation.blade.php
 * resources/views/emails/verify-email.blade.php
 * resources/views/emails/reset-password.blade.php
 */
Auth::routes([
    'reset'     => true, // lasciare sempre a true 
    'register'  => true, // registrazione 
    'confirm'   => true, // conferma registrazione
    'verify'    => true  // verifica email e attivazione
]);

// Rotta personalizzata per il logout
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Fine delle rotte per la gestione dell'autenticazione 

/**
 * Rotte per l'utente Admin
 */
Route::get('/admin', function () {
    return redirect('/admin/home');
});

Route::middleware(['auth', 'role:admin', 'status'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    // Gestione utenti
    Route::resource('user', App\Http\Controllers\Admin\UserController::class)->except(['show']);
    Route::prefix('user')->scopeBindings()->name('user.')->group(function () {
        // Rotte personalizzate gestione utenti
        Route::post('/list', [App\Http\Controllers\Admin\UserController::class, 'list'])->name('list');
        Route::get('/{user}/print', [App\Http\Controllers\Admin\UserController::class, 'print'])->name('print');
        Route::get('/exportToExcel', [App\Http\Controllers\Admin\UserController::class, 'exportToExcel'])->name('exportToExcel');
        Route::get('/import', [App\Http\Controllers\Admin\UserController::class, 'showImport'])->name('showImport');
        Route::post('/import', [App\Http\Controllers\Admin\UserController::class, 'import'])->name('import');
    });

    // Impersonate "login come" un utente — solo un admin può avviarla
    Route::get('/impersonate/take/{id}/{guardName?}', [Lab404\Impersonate\Controllers\ImpersonateController::class, 'take'])->name('impersonate');
});

// Impersonate: uscita raggiungibile da qualsiasi utente autenticato, dato che
// durante l'impersonificazione la sessione attiva è quella dell'utente
// impersonato (che potrebbe non avere il ruolo admin né passare 'status').
Route::middleware(['auth'])->group(function () {
    Route::get('/impersonate/leave', [Lab404\Impersonate\Controllers\ImpersonateController::class, 'leave'])->name('impersonate.leave');
});

/**
 * Rotte per l'utente User
 */
Route::get('/user', function () {
    return redirect('/user/home');
});

 Route::middleware(['auth', 'role:user', 'status'])->prefix('user')->name('user.')->group(function () {
    Route::get('/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
});
