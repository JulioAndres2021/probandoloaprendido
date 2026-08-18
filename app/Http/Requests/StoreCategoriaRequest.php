<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Captura el ID si estás editando, para evitar errores en la regla 'unique'
        $categoriaId = $this->route('categoria') ? $this->route('categoria')->id : null;
        return [
            'nombre' => 'required|string|min:3|max:50|unique:categorias,nombre,' . $categoriaId,
            'descripcion' => 'nullable|string|max:255',
        ];

    }

    public function messages(): array
    {

        return [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto válida.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede superar los 50 caracteres.',
            'nombre.unique' => 'Ya existe una categoría registrada con este nombre.',
            'descripcion.string' => 'La descripción debe ser un texto válido.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
        ];
    }
}
