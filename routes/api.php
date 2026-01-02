<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => '/v1'], function () {

    Route::group(['prefix' => '/auth'], function () {
        Route::post('/register/{type_name}', [App\Http\Controllers\V1\AuthController::class, 'register']);
        Route::post('/login', [App\Http\Controllers\V1\AuthController::class, 'login']);
    });
    Route::group(['prefix' => '/users'], function () {

        Route::group(['prefix' => '/customer'], function () {

            Route::get('/', [App\Http\Controllers\V1\CustomerController::class, 'index']);
            Route::put('/{customer_id}', [App\Http\Controllers\V1\CustomerController::class, 'update']);
            Route::get('/{customer_id}', [App\Http\Controllers\V1\CustomerController::class, 'show']);
        });

        Route::group(['prefix' => '/employee'], function () {

            Route::get('/', [App\Http\Controllers\V1\EmployeeController::class, 'index']);
            Route::put('/{customer_id}', [App\Http\Controllers\V1\EmployeeController::class, 'update']);
            Route::get('/{customer_id}', [App\Http\Controllers\V1\EmployeeController::class, 'show']);
        });
    });
});
