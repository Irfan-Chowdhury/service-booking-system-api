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
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('services')->group(function () {
        Route::controller(ServiceController::class)->group(function () {
            Route::get('/', 'index'); //Customer
            Route::post('/', 'store'); //Admin
            Route::put('/{id}', 'update'); //Admin
            Route::delete('/{id}', 'destroy'); //Admin
        });
    });


    Route::post('/bookings', [BookingController::class, 'store']);
});
