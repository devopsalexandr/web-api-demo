<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group(function () {

    // Auth
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

    // Admin
    Route::prefix('admin')->group(function () {
        Route::post('/user', [\App\Http\Controllers\AdminController::class, 'addUser']);
        Route::patch('/user', [\App\Http\Controllers\AdminController::class, 'updateUser']);
        Route::delete('/user', [\App\Http\Controllers\AdminController::class, 'removeUser']);

        Route::post('/book', [\App\Http\Controllers\AdminController::class, 'addBook']);
        Route::delete('/book', [\App\Http\Controllers\AdminController::class, 'deleteBook']);
    });

    Route::group(['middleware' => ['auth:sanctum']], function(){
        Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    });
});
