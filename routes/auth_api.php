<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');
