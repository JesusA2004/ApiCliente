<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Intentar autenticar al usuario
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Generar el token
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
