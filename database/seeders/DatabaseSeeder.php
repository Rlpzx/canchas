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

      DB::table('usuarios')->insert([
    'nombre' => 'Test User',
    'correo' => 'test@example.com',
    'contrasena' => Hash::make('123456'),
    'id_rol' => 1,
    'created_at' => now(),
    'updated_at' => now(),
]);

    }
}
