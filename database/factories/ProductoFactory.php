<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    /**
     * Define el estado por defecto del modelo.
     */
    public function definition(): array
    {
        // Genera un nombre de producto aleatorio de 2 o 3 palabras
        $nombre = $this->faker->unique()->words(3, true);

        return [
            // Obtiene un ID aleatorio de las categorías que ya existan en la base de datos
            'categoria_id' => Categoria::inRandomOrder()->first()?->id ?? Categoria::factory(),
            'nombre' => ucfirst($nombre),
            'slug' => Str::slug($nombre),
            'descripcion' => $this->faker->paragraph(2),
            // Genera un precio flotante entre 10 y 1000 con 2 decimales
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            // Genera un número entero de stock entre 0 y 100
            'stock' => $this->faker->numberBetween(0, 100),
            // El 90% de los productos estarán activos
            'activo' => $this->faker->boolean(90),
        ];
    }
}
