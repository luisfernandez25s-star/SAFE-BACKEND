<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// 🔐 AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 👤 USUARIO AUTENTICADO (middleware)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 👑 RUTA ADMIN
Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    if ($request->user()->role !== 'admin') {
        return response()->json(['error' => 'No autorizado'], 403);
    }

    return response()->json([
        'message' => 'Bienvenido Admin',
        'user' => $request->user()
    ]);
});