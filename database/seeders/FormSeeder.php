<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\CategoryForm;
use Faker\Factory as Faker;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        
        // Obtener todas las categorías
        $categories = CategoryForm::all();
        
        if ($categories->isEmpty()) {
            $this->command->error('No hay categorías de formularios. Ejecuta CategoryFormSeeder primero.');
            return;
        }

        foreach ($categories as $category) {
            $this->command->info("Creando formularios para categoría: {$category->name}");
            
            for ($i = 1; $i <= 100; $i++) {
                $startDate = $faker->dateTimeBetween('-1 year', '+6 months');
                $endDate = $faker->dateTimeBetween($startDate, '+1 year');
                
                Form::create([
                    'category_form_id' => $category->id,
                    'name' => $this->generateFormName($category->name, $i, $faker),
                    'description' => $faker->sentence(mt_rand(8, 15)), // Genera descripción corta (8-15 palabras)
                    'status' => $faker->randomElement([true, false]), // true = activo, false = inactivo
                    'published_at' => $faker->boolean(70) ? $startDate : null, // 70% probabilidad de tener fecha de publicación
                    'archived_at' => $faker->boolean(60) ? $endDate : null, // 60% probabilidad de tener fecha de archivo
                    'user_id' => 1, // Usar siempre user_id = 1
                ]);
            }
        }
        
        $this->command->info('Seeders de formularios completados: ' . (count($categories) * 100) . ' formularios creados.');
    }

    /**
     * Generar nombres de formularios según la categoría
     */
    private function generateFormName($categoryName, $index, $faker)
    {
        $templates = [
            'Encuestas de Satisfacción' => [
                'Encuesta de Satisfacción del Cliente #{index}',
                'Evaluación de Servicios #{index}',
                'Formulario de Satisfacción #{index}',
                'Encuesta Post-Venta #{index}',
                'Evaluación de Calidad #{index}',
            ],
            'Formularios de Registro' => [
                'Registro de Usuario #{index}',
                'Formulario de Inscripción #{index}',
                'Registro de Cliente #{index}',
                'Formulario de Afiliación #{index}',
                'Registro de Participante #{index}',
            ],
            'Evaluaciones Académicas' => [
                'Examen de {subject} #{index}',
                'Evaluación Final #{index}',
                'Prueba de Conocimientos #{index}',
                'Test Académico #{index}',
                'Evaluación de Competencias #{index}',
            ],
            'Formularios de Contacto' => [
                'Formulario de Contacto #{index}',
                'Consulta General #{index}',
                'Solicitud de Información #{index}',
                'Formulario de Sugerencias #{index}',
                'Contacto Comercial #{index}',
            ],
            'Encuestas de Mercado' => [
                'Investigación de Mercado #{index}',
                'Encuesta de Tendencias #{index}',
                'Análisis de Mercado #{index}',
                'Estudio de Consumidor #{index}',
                'Encuesta de Preferencias #{index}',
            ],
            'Formularios de Solicitud' => [
                'Solicitud de Servicio #{index}',
                'Formulario de Permiso #{index}',
                'Solicitud de Trámite #{index}',
                'Petición Administrativa #{index}',
                'Solicitud de Autorización #{index}',
            ],
            'Evaluaciones de Desempeño' => [
                'Evaluación de Desempeño #{index}',
                'Valoración Laboral #{index}',
                'Evaluación 360° #{index}',
                'Assessment Profesional #{index}',
                'Evaluación de Competencias #{index}',
            ],
            'Formularios de Feedback' => [
                'Formulario de Retroalimentación #{index}',
                'Feedback del Usuario #{index}',
                'Comentarios y Sugerencias #{index}',
                'Evaluación de Experiencia #{index}',
                'Formulario de Opinión #{index}',
            ],
            'Encuestas de Clima Laboral' => [
                'Encuesta de Clima Organizacional #{index}',
                'Evaluación de Ambiente Laboral #{index}',
                'Medición de Clima #{index}',
                'Encuesta de Satisfacción Laboral #{index}',
                'Evaluación de Cultura Empresarial #{index}',
            ],
            'Formularios de Eventos' => [
                'Registro para Evento #{index}',
                'Formulario de Participación #{index}',
                'Inscripción a Conferencia #{index}',
                'Registro de Asistencia #{index}',
                'Formulario de Evento #{index}',
            ],
        ];

        $categoryTemplates = $templates[$categoryName] ?? ['Formulario #{index}'];
        $template = $faker->randomElement($categoryTemplates);
        
        // Reemplazar placeholders
        $name = str_replace('#{index}', str_pad($index, 3, '0', STR_PAD_LEFT), $template);
        
        if (strpos($name, '{subject}') !== false) {
            $subjects = ['Matemáticas', 'Historia', 'Ciencias', 'Literatura', 'Química', 'Física', 'Biología', 'Geografía'];
            $name = str_replace('{subject}', $faker->randomElement($subjects), $name);
        }
        
        return $name;
    }
}
