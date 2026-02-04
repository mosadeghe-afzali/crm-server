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

        Route::group(['prefix' => '/customers'], function () {

            Route::get('/{type?}', [App\Http\Controllers\V1\CustomerController::class, 'index']);
            Route::put('/{customer_id}', [App\Http\Controllers\V1\CustomerController::class, 'update']);
            Route::get('/{customer_id}', [App\Http\Controllers\V1\CustomerController::class, 'show']);
        });

        Route::group(['prefix' => '/employee'], function () {

            Route::get('/', [App\Http\Controllers\V1\EmployeeController::class, 'index']);
            Route::put('/{employee_id}', [App\Http\Controllers\V1\EmployeeController::class, 'update']);
            Route::get('/{employee_id}', [App\Http\Controllers\V1\EmployeeController::class, 'show']);
        });
    });

    Route::group(['prefix' => '/tickets'], function () {
        Route::get('/', [App\Http\Controllers\V1\TicketController::class, 'index']);
        Route::post('/{ticket_id}', [App\Http\Controllers\V1\TicketController::class, 'create']);
        Route::get('/{ticket_id}', [App\Http\Controllers\V1\TicketController::class, 'show']);
        Route::put('/{ticket_id}', [App\Http\Controllers\V1\TicketController::class, 'update']);
    });
});
