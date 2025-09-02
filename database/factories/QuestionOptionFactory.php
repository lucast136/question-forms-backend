<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionOption>
 */
class QuestionOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionOption::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_id' => Question::factory(),
            'question_title' => $this->generateOptionText(),
            'is_correct' => false,
            'weight' => $this->faker->randomFloat(2, 0.5, 2.0),
            'user_id' => 1,
        ];
    }

    /**
     * Genera textos de opciones realistas según contexto
     */
    private function generateOptionText(): string
    {
        $optionSets = [
            // Para preguntas de género
            'genero' => ['Masculino', 'Femenino', 'Prefiero no decir', 'Otro', 'No binario'],
            
            // Para preguntas de estado civil
            'estado_civil' => ['Soltero/a', 'Casado/a', 'Divorciado/a', 'Viudo/a', 'Unión libre'],
            
            // Para preguntas de educación
            'educacion' => ['Secundaria', 'Técnico', 'Universitario', 'Posgrado', 'Doctorado'],
            
            // Para preguntas de edad
            'edad' => ['18-25 años', '26-35 años', '36-45 años', '46-55 años', '56+ años'],
            
            // Para preguntas de calificación
            'calificacion' => ['Excelente', 'Muy bueno', 'Bueno', 'Regular', 'Malo'],
            
            // Para preguntas de experiencia
            'experiencia' => ['Sin experiencia', '1-2 años', '3-5 años', '6-10 años', '10+ años'],
            
            // Para preguntas de tecnología
            'tecnologia' => ['JavaScript', 'Python', 'PHP', 'Java', 'C#'],
            
            // Para preguntas de idiomas
            'idiomas' => ['Español', 'Inglés', 'Francés', 'Portugués', 'Alemán'],
            
            // Para preguntas de países
            'paises' => ['Colombia', 'México', 'Argentina', 'España', 'Estados Unidos'],
            
            // Opciones genéricas
            'genericas' => ['Opción A', 'Opción B', 'Opción C', 'Opción D', 'Opción E'],
        ];

        $randomSet = $this->faker->randomElement($optionSets);
        return $this->faker->randomElement($randomSet);
    }

    /**
     * State para opción correcta
     */
    public function correct()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_correct' => true,
                'weight' => 2.0,
            ];
        });
    }

    /**
     * State para opciones de calificación
     */
    public function rating($weight = 1.0)
    {
        $ratings = ['Excelente', 'Muy bueno', 'Bueno', 'Regular', 'Malo'];
        $weights = [2.0, 1.5, 1.0, 0.5, 0.0];
        
        return $this->state(function (array $attributes) use ($ratings, $weights, $weight) {
            $index = min((int)$weight - 1, count($ratings) - 1);
            return [
                'question_title' => $ratings[$index],
                'weight' => $weights[$index],
            ];
        });
    }
}
