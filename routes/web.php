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
    // -> /admin/
    Route::get('/', function () {
        return redirect('/admin/home');
    });

    // -> /admin/home
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    // Rotte solo per l'utente con ruolo Admin ( 'role:admin' )
    $router->group(['middleware' => ['auth', 'role:admin']], function (Router $router) {
        // Gestione Utenti -> /admin/user/...
        $router->resource('user', App\Http\Controllers\Admin\UserController::class)->except(['show']);
        $router->post('/user/list', [App\Http\Controllers\Admin\UserController::class, 'list'])->name('user.list');
        $router->get('/user/export/excel', [App\Http\Controllers\Admin\UserController::class, 'export_excel'])->name('user.export_excel');
        $router->get('/user/export/gsheet', [App\Http\Controllers\Admin\UserController::class, 'export_gsheet'])->name('user.export_gsheet');
        $router->get('/user/{id}/print', [App\Http\Controllers\Admin\UserController::class, 'print'])->name('user.print');
    });
});

/**
 * Rotte utente non autenticato
 */
Route::get('/', function () {
    return view('welcome');
});
