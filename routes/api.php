<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['prefix' => '/v1/auth'], function () {
    Route::post('/register', [App\Http\Controllers\V1\AuthController::class, 'register'])->name('auth.login');
});

