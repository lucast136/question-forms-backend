<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryForm;
use Illuminate\Support\Facades\DB;

class CategoryFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Encuestas de Satisfacción',
                'description' => 'Formularios para medir la satisfacción del cliente con productos y servicios',
                'user_id' => 1,
            ],
            [
                'name' => 'Formularios de Registro',
                'description' => 'Formularios para el registro de nuevos usuarios y clientes',
                'user_id' => 1,
            ],
            [
                'name' => 'Evaluaciones Académicas',
                'description' => 'Formularios para evaluaciones, exámenes y pruebas académicas',
                'user_id' => 1,
            ],
            [
                'name' => 'Formularios de Contacto',
                'description' => 'Formularios para consultas, sugerencias y contacto general',
                'user_id' => 1,
            ],
            [
                'name' => 'Encuestas de Mercado',
                'description' => 'Formularios para investigación de mercado y análisis de tendencias',
                'user_id' => 1,
            ],
            [
                'name' => 'Formularios de Solicitud',
                'description' => 'Formularios para solicitudes de servicios, permisos y trámites',
                'user_id' => 1,
            ],
            [
                'name' => 'Evaluaciones de Desempeño',
                'description' => 'Formularios para evaluar el desempeño laboral y profesional',
                'user_id' => 1,
            ],
            [
                'name' => 'Formularios de Feedback',
                'description' => 'Formularios para recopilar comentarios y retroalimentación',
                'user_id' => 1,
            ],
            [
                'name' => 'Encuestas de Clima Laboral',
                'description' => 'Formularios para medir el ambiente y clima organizacional',
                'user_id' => 1,
            ],
            [
                'name' => 'Formularios de Eventos',
                'description' => 'Formularios para registro y gestión de eventos y actividades',
                'user_id' => 1,
            ],
        ];

        foreach ($categories as $category) {
            CategoryForm::create($category);
        }
    }
}
