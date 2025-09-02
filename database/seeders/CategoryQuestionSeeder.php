<?php

namespace Database\Seeders;

use App\Models\CategoryQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creando categorías de preguntas...');

        // Crear las 4 categorías de preguntas específicas
        $categories = [
            [
                'name' => 'Información Personal',
                'description' => 'Preguntas relacionadas con datos personales y demográficos del usuario.',
                'user_id' => 1,
            ],
            [
                'name' => 'Evaluación Técnica',
                'description' => 'Preguntas orientadas a evaluar conocimientos y habilidades técnicas.',
                'user_id' => 1,
            ],
            [
                'name' => 'Retroalimentación',
                'description' => 'Preguntas para recopilar opiniones y comentarios de los usuarios.',
                'user_id' => 1,
            ],
            [
                'name' => 'Datos Demográficos',
                'description' => 'Preguntas sobre ubicación, edad, educación y características demográficas.',
                'user_id' => 1,
            ],
        ];

        foreach ($categories as $category) {
            CategoryQuestion::create($category);
            $this->command->info("Categoría creada: {$category['name']}");
        }

        $this->command->info('✅ CategoryQuestionSeeder completado: 4 categorías de preguntas creadas.');
    }
}
