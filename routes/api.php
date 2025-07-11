<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::post('/logout', [AuthController::class, 'logout']);

// User routes (protected by JWT)
Route::middleware('auth:api')->apiResource('users', UserController::class);
// User routes (protected by JWT)
Route::apiResource('users', UserController::class);
// Get authenticated user info
Route::middleware('auth:api')->group(function () {
    // Protected routes
    Route::get('/me', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    });
});

// Route::get('/me', function (Request $request) {
//     return response()->json([
//         'status' => 'success',
//         'data' => $request->user()
//     ]);
// })->middleware('auth:api');