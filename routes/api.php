<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta para listar a todos los clientes (GET)
Route::get('clientes', [ClienteController::class, 'index']);

// Ruta para obtener a un solo cliente
Route::get('clientes/{id}', [ClienteController::class, 'show']);

// Ruta para insertar a varios clientes (POST)
Route::post('multiples/clientes', [ClienteController::class, 'storeMultiple']);

// Ruta para insertar a un solo cliente (PUT)
Route::post('clientes', [ClienteController::class, 'store']);

// Ruta para actualizar a un solo cliente (PUT)
Route::put('clientes/{id}', [ClienteController::class, 'update']);

// Ruta para eliminar a un solo cliente (DELETE)
Route::delete('clientes/{id}', [ClienteController::class, 'destroy']);
