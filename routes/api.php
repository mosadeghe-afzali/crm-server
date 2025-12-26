<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => '/v1'], function () {

    Route::group(['prefix' => '/auth'], function () {
        Route::post('/register', [App\Http\Controllers\V1\AuthController::class, 'register']);
        Route::post('/login', [App\Http\Controllers\V1\AuthController::class, 'login']);
    });
    Route::group(['prefix' => '/users/{type_name}'], function () {
        Route::get('/', [App\Http\Controllers\V1\UserController::class, 'index']);
        Route::put('/{user_id}', [App\Http\Controllers\V1\UserController::class, 'update']);
        Route::get('/{user_id}', [App\Http\Controllers\V1\UserController::class, 'show']);

    });
});
