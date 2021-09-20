<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Route::prefix('v1')->group(function () {
//    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
//});

Route::post('/test', [\App\Http\Controllers\AuthController::class, "index"]);

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
