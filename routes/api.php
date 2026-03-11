<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
});

Route::post('/register',[AuthController::class,'register']);
Route::get('/login',[AuthController::class,'login']);