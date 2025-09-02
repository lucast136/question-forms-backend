<?php

namespace Database\Factories;

use App\Models\CategoryQuestion;
use App\Models\FormSection;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Tipos de control permitidos
     */
    private static $typeControls = ['text', 'radio', 'checkbox', 'dropdown'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_question_id' => CategoryQuestion::factory(),
            'form_section_id' => FormSection::factory(),
            'type_control' => $this->faker->randomElement(self::$typeControls),
            'name' => $this->generateQuestionName(),
            'message_error' => $this->faker->sentence(4),
            'order' => 1,
            'is_required' => $this->faker->boolean(60), // 60% probabilidad de ser requerido
            'description' => $this->faker->optional(0.7)->sentence(6), // 70% probabilidad de tener descripción
            'weight' => $this->faker->randomFloat(2, 0.5, 10.0), // Peso entre 0.5 y 10.0
            'user_id' => 1,
        ];
    }

    /**
     * Genera nombres de preguntas realistas
     */
    private function generateQuestionName(): string
    {
        $questionTypes = [
            'text' => [
                '¿Cuál es tu nombre completo?',
                '¿En qué empresa trabajas actualmente?',
                'Describe tu experiencia laboral',
                '¿Cuál es tu dirección de correo electrónico?',
                'Explica brevemente tu proyecto más reciente',
            ],
            'radio' => [
                '¿Cuál es tu género?',
                '¿Cuál es tu estado civil?',
                '¿Qué nivel de educación has completado?',
                '¿Cuál es tu rango de edad?',
                '¿Cómo calificarías este servicio?',
            ],
            'checkbox' => [
                '¿Qué tecnologías conoces? (Selecciona todas las que apliquen)',
                '¿Cuáles son tus hobbies? (Puedes seleccionar varios)',
                '¿En qué áreas tienes experiencia?',
                '¿Qué idiomas hablas?',
                '¿Qué beneficios valoras más en un trabajo?',
            ],
            'dropdown' => [
                'Selecciona tu país de residencia',
                'Elige tu departamento de trabajo',
                'Selecciona tu nivel de experiencia',
                'Elige tu área de especialización',
                'Selecciona tu horario preferido',
            ],
        ];

        $typeControl = $this->faker->randomElement(self::$typeControls);
        return $this->faker->randomElement($questionTypes[$typeControl]);
    }

    /**
     * State para tipo específico
     */
    public function typeControl(string $type)
    {
        return $this->state(function (array $attributes) use ($type) {
            if (!in_array($type, self::$typeControls)) {
                throw new \InvalidArgumentException("Tipo de control '$type' no permitido");
            }

            return [
                'type_control' => $type,
                'name' => $this->generateQuestionName(),
            ];
        });
    }

    /**
     * State para pregunta requerida
     */
    public function required()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_required' => true,
                'message_error' => 'Este campo es obligatorio.',
            ];
        });
    }

    /**
     * State para pregunta opcional
     */
    public function optional()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_required' => false,
                'message_error' => null,
            ];
        });
    }
}
