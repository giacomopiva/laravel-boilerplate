<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

/**
 * Rotte per l'autenticazione
 * 
 * Per abilitare il reset della password, impostare il valore 'reset' a true
 * Per abilitare la registrazione di un nuovo utente, impostare il valore 'register' a true
 * Per abilitate la conferma della registrazione, impostare il valore 'confirm' a true ??? 
 * Per abilitare la verifica dell'email, impostare il valore 'verify' a true ??? 
 */
Auth::routes(['register' => false, 'confirm' => false, 'reset' => false, 'verify' => false]);

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
