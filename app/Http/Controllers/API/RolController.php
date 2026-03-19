<?php

namespace App\Http\Controllers\API;

use App\Models\Rol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolController extends Controller
{
    public function index()
    {
        return Rol::all();
    }

    public function store(Request $request)
    {
        try {
            // Validamos que el nombre llegue y no sea nulo
            $request->validate([
                'nombre' => 'required|string|max:255',
            ]);

            $rol = Rol::create($request->all());
            return response()->json($rol, 201);

        } catch (\Exception $e) {
            // Esto te devolverá el error real en lugar de un 500 vacío
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        return Rol::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $rol = Rol::findOrFail($id);
        $rol->update($request->all());
        return $rol;
    }

    public function destroy($id)
    {
        Rol::destroy($id);
        return response()->json(['message' => 'Rol eliminado']);
    }
}