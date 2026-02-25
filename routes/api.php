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
        Route::middleware('auth:api')->post('/logout', [App\Http\Controllers\V1\AuthController::class, 'logout']);
    });

    Route::group(['prefix' => '/users'], function () {

        Route::group(['prefix' => '/customers'], function () {

            Route::get('/{type?}', [App\Http\Controllers\V1\CustomerController::class, 'index']);
            Route::put('/{customer_id}', [App\Http\Controllers\V1\CustomerController::class, 'update']);
            Route::get('/{customer_id}/show', [App\Http\Controllers\V1\CustomerController::class, 'show']);
        });

        Route::group(['prefix' => '/employees'], function () {

            Route::get('/', [App\Http\Controllers\V1\EmployeeController::class, 'index']);
            Route::put('/{employee_id}', [App\Http\Controllers\V1\EmployeeController::class, 'update']);
            Route::get('/{employee_id}/show', [App\Http\Controllers\V1\EmployeeController::class, 'show']);
            Route::get('/{position_id}/permissions', [App\Http\Controllers\V1\EmployeeController::class, 'positionPermissions']);

            Route::group(['prefix' => '/{employee_id'], function () {

                Route::group(['prefix' => '/roles'], function () {
                    Route::post('/', [App\Http\Controllers\V1\EmployeeController::class, 'assignRole']);
                    Route::get('/', [App\Http\Controllers\V1\EmployeeController::class, 'roles']);
                });
            });
        });
    });

    Route::group(['prefix' => '/tickets'], function () {
        Route::get('/', [App\Http\Controllers\V1\TicketController::class, 'index']);
        Route::post('/', [App\Http\Controllers\V1\TicketController::class, 'create']);
        Route::post('/{ticket_id}/reply', [App\Http\Controllers\V1\TicketController::class, 'reply']);
        Route::get('/report', [App\Http\Controllers\V1\TicketController::class, 'report']);

        Route::group(['prefix' => '/priorities'], function () {
            Route::get('/', [App\Http\Controllers\V1\TicketController::class, 'proorities']);
        });

        Route::group(['prefix' => '/statuses'], function () {
            Route::get('/', [App\Http\Controllers\V1\TicketController::class, 'statuses']);
        });
        Route::put('/{ticket_id}', [App\Http\Controllers\V1\TicketController::class, 'update']);
        Route::get('/{ticket_id}', [App\Http\Controllers\V1\TicketController::class, 'show']);
    });

    Route::group(['prefix' => '/provinces'], function () {
        Route::get('/', [App\Http\Controllers\V1\GeneralController::class, 'provinces']);
    });
    Route::group(['prefix' => '/cities'], function () {
        Route::get('/', [App\Http\Controllers\V1\GeneralController::class, 'cities']);
    });

    Route::group(['prefix' => '/departments'], function () {
        Route::get('/', [App\Http\Controllers\V1\DepartmentController::class, 'index']);
    });
    Route::group(['prefix' => '/positions'], function () {
        Route::get('/', [App\Http\Controllers\V1\PositionController::class, 'index']);
    });

    Route::group(['prefix' => '/permissions'], function () {
        Route::post('/', [App\Http\Controllers\V1\PermissionController::class, 'store']);
        Route::get('/', [App\Http\Controllers\V1\PermissionController::class, 'index']);
    });

    Route::group(['prefix' => '/roles'], function () {
        Route::post('/', [App\Http\Controllers\V1\PermissionController::class, 'roleStore']);
        Route::get('/', [App\Http\Controllers\V1\PermissionController::class, 'roleIndex']);

        Route::group(['prefix' => '/{role_id}'], function () {

            Route::group(['prefix' => '/permissions'], function () {
                Route::get('/', [App\Http\Controllers\V1\PermissionController::class, 'rolePermissions']);
                Route::post('/{permission_id}', [App\Http\Controllers\V1\PermissionController::class, 'assignrolePermissions']);
            });
        });
    });
});
