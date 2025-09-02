<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\FormSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormSection>
 */
class FormSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormSection::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'form_id' => Form::factory(),
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(6),
            'order' => 1,
            'user_id' => 1,
        ];
    }

    /**
     * States para secciones específicas
     */
    public function datosGenerales($order = 1)
    {
        return $this->state(function (array $attributes) use ($order) {
            return [
                'title' => 'Datos Generales',
                'description' => 'Información básica y general del formulario.',
                'order' => $order,
            ];
        });
    }

    public function informacionEspecifica($order = 2)
    {
        return $this->state(function (array $attributes) use ($order) {
            return [
                'title' => 'Información Específica',
                'description' => 'Detalles específicos relacionados con el propósito del formulario.',
                'order' => $order,
            ];
        });
    }

    public function evaluacion($order = 3)
    {
        return $this->state(function (array $attributes) use ($order) {
            return [
                'title' => 'Evaluación',
                'description' => 'Sección destinada a evaluaciones y valoraciones.',
                'order' => $order,
            ];
        });
    }

    public function comentariosFinales($order = 4)
    {
        return $this->state(function (array $attributes) use ($order) {
            return [
                'title' => 'Comentarios Finales',
                'description' => 'Espacio para comentarios adicionales y observaciones finales.',
                'order' => $order,
            ];
        });
    }
}
