<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware(['role:admin'])->group(function () {
        Route::prefix('services')->group(function () {
            Route::controller(ServiceController::class)->group(function () {
                Route::post('/', 'store');
                Route::put('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });
        Route::get('/admin/bookings', [BookingController::class, 'getAllBookingsByAdmin']);
    });


    Route::middleware(['role:customer'])->group(function () {
        Route::get('/services', [ServiceController::class, 'index']);
        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingController::class, 'getAllBookingsByCustomer']);
            Route::post('/', [BookingController::class, 'store']);
        });
    });

});
