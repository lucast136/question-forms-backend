<?php

namespace Database\Seeders;

use App\Models\CategoryQuestion;
use App\Models\FormSection;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creando preguntas...');

        $faker = Faker::create('es_ES');
        
        // Obtener todas las secciones de formularios y categorías de preguntas
        $formSections = FormSection::all();
        $categoryQuestions = CategoryQuestion::all();
        
        $totalSections = $formSections->count();
        $this->command->info("Procesando {$totalSections} secciones de formularios...");

        // Tipos de control permitidos
        $typeControls = ['text', 'radio', 'checkbox', 'dropdown'];

        // Templates de preguntas por tipo de control
        $questionTemplates = [
            'text' => [
                '¿Cuál es tu nombre completo?',
                '¿En qué empresa trabajas actualmente?',
                'Describe tu experiencia laboral',
                'Explica brevemente tu proyecto más reciente',
                '¿Cuáles son tus objetivos profesionales?',
                'Comenta sobre tus habilidades principales',
                'Describe tu formación académica',
                'Menciona tus logros más importantes',
            ],
            'radio' => [
                '¿Cuál es tu género?',
                '¿Cuál es tu estado civil?',
                '¿Qué nivel de educación has completado?',
                '¿Cuál es tu rango de edad?',
                '¿Cómo calificarías este servicio?',
                '¿Cuál es tu nivel de experiencia?',
                '¿Prefieres trabajo remoto o presencial?',
                '¿Cuál es tu disponibilidad horaria?',
            ],
            'checkbox' => [
                '¿Qué tecnologías conoces? (Selecciona todas las que apliquen)',
                '¿Cuáles son tus hobbies? (Puedes seleccionar varios)',
                '¿En qué áreas tienes experiencia?',
                '¿Qué idiomas hablas?',
                '¿Qué beneficios valoras más en un trabajo?',
                '¿Qué certificaciones posees?',
                '¿En qué modalidades puedes trabajar?',
                '¿Qué herramientas de desarrollo usas?',
            ],
            'dropdown' => [
                'Selecciona tu país de residencia',
                'Elige tu departamento de trabajo',
                'Selecciona tu nivel de experiencia',
                'Elige tu área de especialización',
                'Selecciona tu horario preferido',
                'Elige tu sector de interés',
                'Selecciona tu modalidad de trabajo preferida',
                'Elige tu rango salarial esperado',
            ],
        ];

        $totalQuestions = 0;
        $processedSections = 0;

        foreach ($formSections as $section) {
            // Crear 3 preguntas por cada sección
            for ($i = 1; $i <= 3; $i++) {
                $typeControl = $faker->randomElement($typeControls);
                $categoryQuestion = $faker->randomElement($categoryQuestions);
                
                $questionName = $faker->randomElement($questionTemplates[$typeControl]);
                
                Question::create([
                    'category_question_id' => $categoryQuestion->id,
                    'form_section_id' => $section->id,
                    'type_control' => $typeControl,
                    'name' => $questionName,
                    'message_error' => $this->generateErrorMessage($typeControl),
                    'order' => $i,
                    'is_required' => $faker->boolean(60), // 60% probabilidad de ser requerido
                    'description' => $faker->optional(0.7)->sentence(6), // 70% probabilidad de tener descripción
                    'weight' => $faker->randomFloat(2, 0.5, 10.0), // Peso entre 0.5 y 10.0
                    'user_id' => 1,
                ]);
                
                $totalQuestions++;
            }

            $processedSections++;
            
            // Mostrar progreso cada 500 secciones
            if ($processedSections % 500 === 0) {
                $this->command->info("Procesadas {$processedSections}/{$totalSections} secciones...");
            }
        }

        $this->command->info("✅ QuestionSeeder completado: {$totalQuestions} preguntas creadas para {$totalSections} secciones.");
    }

    /**
     * Genera mensajes de error apropiados según el tipo de control
     */
    private function generateErrorMessage(string $typeControl): string
    {
        $errorMessages = [
            'text' => 'Por favor, complete este campo de texto.',
            'radio' => 'Debe seleccionar una opción.',
            'checkbox' => 'Debe seleccionar al menos una opción.',
            'dropdown' => 'Debe seleccionar un valor de la lista.',
        ];

        return $errorMessages[$typeControl] ?? 'Este campo es obligatorio.';
    }
}
