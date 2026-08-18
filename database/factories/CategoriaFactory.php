<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Genera un nombre de palabra única y asegura que sea único
            'nombre' => $this->faker->unique()->word(),
            // Genera un texto corto de hasta 200 caracteres
            'descripcion' => $this->faker->sentence(10),
        ];
    }
}
