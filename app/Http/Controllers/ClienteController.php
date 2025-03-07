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

    public function storeMultiple(Request $request)
    {
        // Validar que el JSON sea un array de clientes
        $request->validate([
            'clientes' => 'required|array',
            'clientes.*.Nombre' => 'required|string|max:255',
            'clientes.*.Apellido' => 'required|string|max:255',
            'clientes.*.Email' => 'required|string|max:255',
            'clientes.*.Telefono' => 'required|string|max:255',
            'clientes.*.Ciudad' => 'required|string|max:255',
        ]);

        // Obtener los clientes del JSON
        $clientes = $request->input('clientes');

        // Insertar todos los clientes en una sola consulta
        Cliente::insert($clientes);

        return response()->json([
            'message' => 'Clientes insertados correctamente',
            'total_clientes' => count($clientes)
        ], 201);
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
        // Buscar el cliente por su ID
        $cliente = Cliente::find($id);

        // Verificar si el cliente existe
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        // Retornar el cliente en formato JSON
        return response()->json($cliente, 200);
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

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ], 200);
    }

}
