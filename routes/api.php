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
    // Ruta para listar a todos los clientes (GET)
    Route::get('clientes', [ClienteController::class, 'index']);

    // Ruta para obtener un solo cliente (GET)
    Route::get('clientes/{id}', [ClienteController::class, 'show']);

    // Ruta para insertar a varios clientes (POST)
    Route::post('clientes/multiple', [ClienteController::class, 'storeMultiple']);

    // Ruta para insertar un solo cliente (POST)
    Route::post('clientes', [ClienteController::class, 'store']);

    // Ruta para actualizar un cliente (PUT)
    Route::put('clientes/{id}', [ClienteController::class, 'update']);

    // Ruta para eliminar un cliente (DELETE)
    Route::delete('clientes/{id}', [ClienteController::class, 'destroy']);
});
