<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);

// User routes (protected by JWT)
Route::apiResource('users', UserController::class);

// Get authenticated user info
Route::get('/me', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'data' => $request->user()
    ]);
})->middleware('auth:api');