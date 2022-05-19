<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

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

Auth::routes();
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

/** 
 * Admin 
 */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (Router $router) {
    $router->group(['middleware' => ['auth', 'role:admin']], function (Router $router) {        
        // /admin porta a /admin/home
        Route::get('/', function () {
            return redirect('/admin/home');
        });
        
        // /admin/home
        Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        
        /*Route::prefix('name')->name('name.')->group(function () { ... }); */

        // Gestione Utenti
        $router->resource('user', App\Http\Controllers\Admin\UserController::class)->except(['show']);
        $router->post('/user/list', [App\Http\Controllers\Admin\UserController::class, 'list'])->name('user.list');
        $router->get('/user/export/excel', [App\Http\Controllers\Admin\UserController::class, 'export_excel'])->name('user.export_excel');
        $router->get('/user/export/gsheet', [App\Http\Controllers\Admin\UserController::class, 'export_gsheet'])->name('user.export_gsheet');
        $router->get('/user/{id}/print', [App\Http\Controllers\Admin\UserController::class, 'print'])->name('user.print');
    });
});

/** 
 * User 
 */
Route::middleware('auth')->group(function (Router $router) {
    Route::get('/home', function () {
        return view('home');
    });
});

/** 
 * Guest 
 */
Route::get('/', function () {
    return view('welcome');
});
