<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index(): JsonResponse
    {
        // Se cargan los productos paginados junto con los datos de su categoría (Eager Loading)
        $productos = Producto::with('categoria')->paginate(10);
        return response()->json([
            'status' => 'success',
            'code' => '200',
            'message' => 'Producto creado correctamente.',
            'data' => $productos->load('categoria')
        ], 200);
    }

    public function store(StoreProductoRequest $request): JsonResponse
    {

        $datos = $request->validated();
        // Genera el slug automáticamente basándose en el nombre
        $datos['slug'] = Str::slug($datos['nombre']);

        $producto = Producto::create($datos);

        return response()->json([
            'status' => 'success',
            'code' => '201',
            'message' => 'Producto creado correctamente.',
            'data' => $producto->load('categoria')
        ], 201);

    }

    public function show(Producto $producto): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'code' => '200',
            'data' => $producto->load('categoria')
        ], 200);
    }

    public function update(UpdateProductoRequest $request, Producto $producto): JsonResponse
    {

        $datos = $request->validated();

        if (isset($datos['nombre'])) {
                $datos['slug'] = Str::slug($datos['nombre']);
        }

        $producto->update($datos);

        return response()->json([
            'status' => 'success',
            'code' => '200',
            'message' => 'Producto actualizado correctamente.',
            'data' => $producto->load('categoria')
        ], 200);

    }

    public function destroy(Producto $producto): JsonResponse
    {

        $producto->delete();
        return response()->json([
            'status' => 'success',
            'code' => '200',
            'message' => 'Producto eliminado correctamente.'
        ], 200);

    }
}