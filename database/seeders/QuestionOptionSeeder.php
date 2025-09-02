<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuestionOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creando opciones de preguntas...');

        $faker = Faker::create('es_ES');
        
        // Obtener todas las preguntas que requieren opciones (radio, checkbox, dropdown)
        $questions = Question::whereIn('type_control', ['radio', 'checkbox', 'dropdown'])->get();
        
        $totalQuestions = $questions->count();
        $this->command->info("Procesando {$totalQuestions} preguntas que requieren opciones...");

        // Templates de opciones por contexto
        $optionTemplates = [
            'genero' => [
                ['text' => 'Masculino', 'value' => 'male'],
                ['text' => 'Femenino', 'value' => 'female'],
                ['text' => 'Prefiero no decir', 'value' => 'prefer_not_to_say'],
                ['text' => 'Otro', 'value' => 'other'],
                ['text' => 'No binario', 'value' => 'non_binary'],
            ],
            'estado_civil' => [
                ['text' => 'Soltero/a', 'value' => 'single'],
                ['text' => 'Casado/a', 'value' => 'married'],
                ['text' => 'Divorciado/a', 'value' => 'divorced'],
                ['text' => 'Viudo/a', 'value' => 'widowed'],
                ['text' => 'Unión libre', 'value' => 'common_law'],
            ],
            'educacion' => [
                ['text' => 'Secundaria', 'value' => 'high_school'],
                ['text' => 'Técnico', 'value' => 'technical'],
                ['text' => 'Universitario', 'value' => 'university'],
                ['text' => 'Posgrado', 'value' => 'postgraduate'],
                ['text' => 'Doctorado', 'value' => 'doctorate'],
            ],
            'edad' => [
                ['text' => '18-25 años', 'value' => '18_25'],
                ['text' => '26-35 años', 'value' => '26_35'],
                ['text' => '36-45 años', 'value' => '36_45'],
                ['text' => '46-55 años', 'value' => '46_55'],
                ['text' => '56+ años', 'value' => '56_plus'],
            ],
            'calificacion' => [
                ['text' => 'Excelente', 'value' => 'excellent'],
                ['text' => 'Muy bueno', 'value' => 'very_good'],
                ['text' => 'Bueno', 'value' => 'good'],
                ['text' => 'Regular', 'value' => 'regular'],
                ['text' => 'Malo', 'value' => 'bad'],
            ],
            'experiencia' => [
                ['text' => 'Sin experiencia', 'value' => 'no_experience'],
                ['text' => '1-2 años', 'value' => '1_2_years'],
                ['text' => '3-5 años', 'value' => '3_5_years'],
                ['text' => '6-10 años', 'value' => '6_10_years'],
                ['text' => '10+ años', 'value' => '10_plus_years'],
            ],
            'tecnologia' => [
                ['text' => 'JavaScript', 'value' => 'javascript'],
                ['text' => 'Python', 'value' => 'python'],
                ['text' => 'PHP', 'value' => 'php'],
                ['text' => 'Java', 'value' => 'java'],
                ['text' => 'C#', 'value' => 'csharp'],
            ],
            'idiomas' => [
                ['text' => 'Español', 'value' => 'spanish'],
                ['text' => 'Inglés', 'value' => 'english'],
                ['text' => 'Francés', 'value' => 'french'],
                ['text' => 'Portugués', 'value' => 'portuguese'],
                ['text' => 'Alemán', 'value' => 'german'],
            ],
            'paises' => [
                ['text' => 'Colombia', 'value' => 'colombia'],
                ['text' => 'México', 'value' => 'mexico'],
                ['text' => 'Argentina', 'value' => 'argentina'],
                ['text' => 'España', 'value' => 'spain'],
                ['text' => 'Estados Unidos', 'value' => 'usa'],
            ],
            'genericas' => [
                ['text' => 'Opción A', 'value' => 'option_a'],
                ['text' => 'Opción B', 'value' => 'option_b'],
                ['text' => 'Opción C', 'value' => 'option_c'],
                ['text' => 'Opción D', 'value' => 'option_d'],
                ['text' => 'Opción E', 'value' => 'option_e'],
            ],
        ];

        $totalOptions = 0;
        $processedQuestions = 0;

        foreach ($questions as $question) {
            // Seleccionar un template de opciones basado en el contenido de la pregunta
            $selectedTemplate = $this->selectTemplateByQuestionContent($question->name, $optionTemplates);
            
            // Crear 5 opciones por pregunta
            for ($i = 0; $i < 5; $i++) {
                $option = $selectedTemplate[$i];
                
                QuestionOption::create([
                    'question_id' => $question->id,
                    'question_title' => $option['text'],
                    'is_correct' => $i === 0, // Primera opción como correcta
                    'weight' => $faker->randomFloat(2, 0.5, 2.0), // Peso entre 0.5 y 2.0
                    'user_id' => 1,
                ]);
                
                $totalOptions++;
            }

            $processedQuestions++;
            
            // Mostrar progreso cada 1000 preguntas
            if ($processedQuestions % 1000 === 0) {
                $this->command->info("Procesadas {$processedQuestions}/{$totalQuestions} preguntas...");
            }
        }

        $this->command->info("✅ QuestionOptionSeeder completado: {$totalOptions} opciones creadas para {$totalQuestions} preguntas.");
    }

    /**
     * Selecciona el template de opciones más apropiado basado en el contenido de la pregunta
     */
    private function selectTemplateByQuestionContent(string $questionName, array $templates): array
    {
        $questionLower = strtolower($questionName);
        
        // Mapear palabras clave a templates
        $keywordMap = [
            'género' => 'genero',
            'sexo' => 'genero',
            'estado civil' => 'estado_civil',
            'casado' => 'estado_civil',
            'educación' => 'educacion',
            'estudio' => 'educacion',
            'edad' => 'edad',
            'años' => 'edad',
            'califica' => 'calificacion',
            'valorar' => 'calificacion',
            'experiencia' => 'experiencia',
            'tecnología' => 'tecnologia',
            'programación' => 'tecnologia',
            'idioma' => 'idiomas',
            'habla' => 'idiomas',
            'país' => 'paises',
            'residencia' => 'paises',
        ];

        // Buscar coincidencias de palabras clave
        foreach ($keywordMap as $keyword => $template) {
            if (strpos($questionLower, $keyword) !== false) {
                return $templates[$template];
            }
        }

        // Si no hay coincidencias, usar opciones genéricas
        return $templates['genericas'];
    }
}
