<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->name('v1')->group(function () {

    Route::get('/info', function (Request $request) {
        return response()->json([
            'app_name' => config('app.name'),
            'env' => config('app.env'),
            'api' => 'v1'
        ]);
    });

});
