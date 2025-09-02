<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\RelationController;
use App\Models\CategoryForm;
use App\Http\Requests\FormRequest;
use App\Models\CategoryQuestion;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormController extends RelationController
{
    use DisableAuthorization;

    protected $model = CategoryForm::class;
    protected $relation = 'forms';

// ✅ Agregar logging para detectar duplicación
    protected function beforeIndex(Request $request, $parentEntity)
    {
        $requestId = uniqid();

        Log::info("🔍 [FormController] beforeIndex ejecutado", [
            'request_id' => $requestId,
            'timestamp' => now()->format('Y-m-d H:i:s.u'),
            'memory_usage' => memory_get_usage(true),
            'parent_entity_id' => $parentEntity?->id,
            'user_id' => $request->user()?->id,
            'request_data' => $request->all(),
            'url' => $request->fullUrl(),
            'method' => $request->method()
        ]);

        return parent::beforeIndex($request, $parentEntity);
    }


    // funcion desdepues de insertar un registro
 protected function afterStore(Request $request, $parentEntity, $entity)
    {
        // agregar una seccion por defecto
        $section = $entity->formSections()->create([
            'title' => 'Sección por defecto',
            'description' => '',
            'order' => 1,
            'user_id' => auth()->user()->id,
        ]);
        //obtenemos la primera categoria de pregunta del usuario logueado
        $categoryQuestion=CategoryQuestion::where('user_id', auth()->user()->id)->first();
        //agregamos una pregunta a las seccion
        $question=$section->questions()->create([
            'category_question_id' => $categoryQuestion ? $categoryQuestion->id : null,
            'form_section_id' => $section->id,
            'type_control' => 'text',
            'name' => 'Pregunta 1',
            'message_error' => '',
            'order' => 1,
            'is_required' => false,
            'description' => '',
            'weight' => 0,
            'user_id' => auth()->user()->id,
        ]);
        //agregamos question options
        $questionOption = $question->questionOptions()->create([
            'question_title' => '',
            'is_correct' => true,
            'weight' => 0,
            'user_id' => auth()->user()->id,
        ]);
    }


    public function limit(): int
    {
        return 50;
    }

    public function searchableBy(): array
    {
        return ['name','description'];
    }

    public function filterableBy(): array
    {
        return ['user_id'];
    }

    protected function request()
    {
        return FormRequest::class;
    }
    public function aggregates() : array
    {
        return ['formSections'];
    }
    public function includes(): array
    {
        return ['formSections',
            'formSections.questions',
            'formSections.questions.categoryQuestion',
            'formSections.questions.questionOptions'
            ];
    }
}
