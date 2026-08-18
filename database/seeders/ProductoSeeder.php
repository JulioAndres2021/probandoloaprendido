<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Ejecuta las semillas de la base de datos.
     */
    public function run(): void
    {
        // Verificación de seguridad: si no hay categorías, creamos algunas primero
        if (Categoria::count() === 0) {
            Categoria::factory()->count(5)->create();
        }

        // Crea 50 productos aleatorios asociados a las categorías existentes
        Producto::factory()->count(50)->create();
    }
}
