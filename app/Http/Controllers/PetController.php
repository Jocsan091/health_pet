<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        return response()->json([
            'data' => $pets,
            'code' => 200,
            'message' => 'Mascotas obtenidas exitosamente'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'especie' => 'required|string|max:20',
            'raza' => 'nullable|string|max:20',
            'sexo' => 'required|string|size:1',
            'fechaNacimiento' => 'required|date',
            'numeroAtenciones' => 'required|integer',
            'enTratamiento' => 'boolean'
        ]);

        $pet = Pet::create($validatedData);

        return response()->json([
            'data' => $pet,
            'code' => 201,
            'message' => 'Mascota creada exitosamente'
        ], 201);
    }

    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        return response()->json([
            'data' => $pet,
            'code' => 200,
            'message' => 'Mascota obtenida exitosamente'
        ]);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:50',
            'especie' => 'sometimes|required|string|max:20',
            'raza' => 'nullable|string|max:20',
            'sexo' => 'sometimes|required|string|size:1',
            'fechaNacimiento' => 'sometimes|required|date',
            'numeroAtenciones' => 'sometimes|required|integer',
            'enTratamiento' => 'boolean'
        ]);

        $pet->update($validatedData);

        return response()->json([
            'data' => $pet,
            'code' => 200,
            'message' => 'Mascota actualizada exitosamente'
        ]);
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return response()->json([
            'data' => null,
            'code' => 200,
            'message' => 'Mascota eliminada exitosamente'
        ]);
    }

    public function filtrarPorEspecie($especie)
    {
        $pets = Pet::where('especie', $especie)->get();

        return response()->json([
            'data' => $pets,
            'code' => 200,
            'message' => 'Mascotas filtradas por especie exitosamente'
        ]);
    }
}