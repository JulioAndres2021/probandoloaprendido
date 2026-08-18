<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categorias = Categoria::all();
        return response()->json([
            'data' => $categorias,
            'mensaje' => 'Categorías recuperadas con éxito.'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request): JsonResponse
    {
        // 1. Obtiene los datos ya validados por el FormRequest
            $datosValidados = $request->validated();

            // 2. Crea el registro en la base de datos
            $categoria = Categoria::create($datosValidados);

            // 3. Retorna la respuesta JSON con código HTTP 201 (Created)
            return response()->json([
                'status' => 'success',
                'message' => 'Categoría creada correctamente.',
                'data' => $categoria
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria): JsonResponse
    {
        // Laravel busca automáticamente la categoría por su ID.
        // Si no la encuentra, devuelve un error 404 automáticamente.
        return response()->json([
            'status' => 'success',
            'data' => $categoria
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria): JsonResponse
    {
        // 1. Obtiene únicamente los datos validados por el UpdateCategoriaRequest
            $datosValidados = $request->validated();

            // 2. Actualiza el registro con los nuevos datos
            $categoria->update($datosValidados);

            // 3. Retorna la respuesta JSON con el recurso actualizado y código 200 (OK)
            return response()->json([
                'status' => 'success',
                'message' => 'Categoría actualizada correctamente.',
                'data' => $categoria
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria): JsonResponse
    {
        // Elimina el registro por completo de la base de datos
            $categoria->delete();

            // Retorna una respuesta de éxito con código HTTP 200 (OK)
            return response()->json([
                'status' => 'success',
                'message' => 'Categoría eliminada correctamente.'
            ], 200);
    }
}
