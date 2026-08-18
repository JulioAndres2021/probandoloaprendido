<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productoId = $this->route('producto') ? $this->route('producto')->id : null;

        return [
            'categoria_id' => 'sometimes|required|exists:categorias,id',
            'nombre' => 'sometimes|required|string|min:3|max:100|unique:productos,nombre,' . $productoId,
            'descripcion' => 'nullable|string|max:1000',
            'precio' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'activo' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
            'nombre.unique' => 'El nombre ya está en uso por otro producto.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'stock.integer' => 'El stock debe ser un número entero.',
        ];
    }
}