<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group(function () {
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function(){
        Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    });
});
