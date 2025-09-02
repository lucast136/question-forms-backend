<?php

namespace Database\Factories;

use App\Models\CategoryQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryQuestion>
 */
class CategoryQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(8),
            'status' => true,
            'user_id' => 1,
        ];
    }

    /**
     * States para categorías específicas
     */
    public function informacionPersonal()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Información Personal',
                'description' => 'Preguntas relacionadas con datos personales y demográficos del usuario.',
            ];
        });
    }

    public function evaluacionTecnica()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Evaluación Técnica',
                'description' => 'Preguntas orientadas a evaluar conocimientos y habilidades técnicas.',
            ];
        });
    }

    public function retroalimentacion()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Retroalimentación',
                'description' => 'Preguntas para recopilar opiniones y comentarios de los usuarios.',
            ];
        });
    }

    public function datosDemograficos()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Datos Demográficos',
                'description' => 'Preguntas sobre ubicación, edad, educación y características demográficas.',
            ];
        });
    }
}
