<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuthController;

// Ruta para obtener el usuario autenticado (requiere autenticación con Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// Ruta para autenticar a un usuario (POST)
Route::post('login', [AuthController::class, 'login']);

// Grupo de rutas protegidas por autenticación con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('clientes', [ClienteController::class, 'index']);
    Route::get('clientes/{id}', [ClienteController::class, 'show']);
    Route::post('clientes/multiple', [ClienteController::class, 'storeMultiple']);
    Route::post('clientes', [ClienteController::class, 'store']);
    Route::put('clientes/{id}', [ClienteController::class, 'update']);
    Route::delete('clientes/{id}', [ClienteController::class, 'destroy']);
});