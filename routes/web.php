<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Rotte per il login
 */
Auth::routes(['register' => false]);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout'); // per avere il logout con verbo get e quindi gestibile anche da un link

/**
 * Rotte per gli utenti amministratori (che hanno accesso al backend)
 */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (Router $router) {
    // -> /admin
    Route::get('/', function () {
        return redirect('/admin/home');
    });

    // -> /admin/home
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    // Rotte solo per l'utente con ruolo Admin ( 'role:admin' )
    $router->group(['middleware' => ['auth', 'role:admin']], function (Router $router) {
        // Gestione Utenti -> /admin/user/...
        $router->resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show']);
        $router->post('/users/list', [App\Http\Controllers\Admin\UserController::class, 'list'])->name('users.list');
        $router->get('/users/export/excel', [App\Http\Controllers\Admin\UserController::class, 'export_excel'])->name('users.export_excel');
        $router->get('/users/export/gsheet', [App\Http\Controllers\Admin\UserController::class, 'export_gsheet'])->name('users.export_gsheet');
        $router->get('/users/{user}/print', [App\Http\Controllers\Admin\UserController::class, 'print'])->name('users.print');
    });
});

/**
 * Rotte utente non autenticato
 */
Route::get('/', function () {
    return redirect('/comingsoon');
})->name('home');

Route::get('/comingsoon', function () {
    return view('comingsoon');
})->name('comingsoon');

// View standard di laravel
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
