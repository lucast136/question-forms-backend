<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creando secciones de formularios...');

        // Obtener todos los formularios
        $forms = Form::all();
        $totalForms = $forms->count();
        $this->command->info("Procesando {$totalForms} formularios...");

        $sectionTemplates = [
            [
                'title' => 'Datos Generales',
                'description' => 'Información básica y general del formulario.',
                'order' => 1,
            ],
            [
                'title' => 'Información Específica',
                'description' => 'Detalles específicos relacionados con el propósito del formulario.',
                'order' => 2,
            ],
            [
                'title' => 'Evaluación',
                'description' => 'Sección destinada a evaluaciones y valoraciones.',
                'order' => 3,
            ],
            [
                'title' => 'Comentarios Finales',
                'description' => 'Espacio para comentarios adicionales y observaciones finales.',
                'order' => 4,
            ],
        ];

        $totalSections = 0;
        $processedForms = 0;

        foreach ($forms as $form) {
            // Crear 4 secciones por cada formulario
            foreach ($sectionTemplates as $template) {
                FormSection::create([
                    'form_id' => $form->id,
                    'title' => $template['title'],
                    'description' => $template['description'],
                    'order' => $template['order'],
                    'user_id' => 1,
                ]);
                $totalSections++;
            }

            $processedForms++;
            
            // Mostrar progreso cada 100 formularios
            if ($processedForms % 100 === 0) {
                $this->command->info("Procesados {$processedForms}/{$totalForms} formularios...");
            }
        }

        $this->command->info("✅ FormSectionSeeder completado: {$totalSections} secciones creadas para {$totalForms} formularios.");
    }
}
