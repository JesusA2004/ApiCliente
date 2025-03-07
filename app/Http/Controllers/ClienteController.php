<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::all();
        return $cliente;
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellido' => 'required|string|max:255',
            'Email' => 'required|string|max:255',
            'Telefono' => 'required|string|max:255',
            'Ciudad' => 'required|string|max:255',
        ]);
        $cliente = Cliente::create([
            'Nombre' => $request->Nombre,
            'Apellido' => $request->Apellido,
            'Email' => $request->Email,
            'Telefono' => $request->Telefono,
            'Ciudad' => $request->Ciudad,
        ]);
        return response()->json($cliente, 201);
    }

    public function show($id)
    {
        return view('cliente.show');
    }

    public function edit($id)
    {
        return view('cliente.edit');
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        
        if(!$cliente){
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellido' => 'required|string|max:255',
            'Email' => 'required|string|max:255',
            'Telefono' => 'required|string|max:255',
            'Ciudad' => 'required|string|max:255',
        ]);

        $cliente->update($request->only([
            'Nombre',
            'Apellido',
            'Email',
            'Telefono',
            'Ciudad',
        ]));

        return response()->json([
            'message' => 'Cliente actualizado correctamente',
            'cliente' => $cliente
        ],200);
    }

    public function destroy($id)
    {
        $cliente->delete();
        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ], 200);
    }

}
