<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios base para los seeders
        User::factory()->create([
            'DNI' => '12345678',
            'name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'phone' => '987654321',
            'is_admin' => 1,
            'status' => 1,
        ]);

        // Crear usuarios adicionales
        User::factory(4)->create();

        // Ejecutar seeders de formularios en orden correcto
        $this->call([
            CategoryFormSeeder::class,
            FormSeeder::class,
            CategoryQuestionSeeder::class,
            FormSectionSeeder::class,
            QuestionSeeder::class,
            QuestionOptionSeeder::class,
        ]);
    }
}
