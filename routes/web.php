<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('clientes',[ClienteController::class,'index']);
Route::post('login', [AuthController::class, 'login']);
