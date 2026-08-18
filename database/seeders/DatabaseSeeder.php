<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $this->call([
            CategoriaSeeder::class, // Primero se crean las categorías obligatoriamente
            ProductoSeeder::class,  // Luego se crean los productos apuntando a esas categorías
        ]);
    }
}