<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\RelationController;
use App\Models\FormSection;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;

class QuestionController extends RelationController
{
    use DisableAuthorization;

    protected $model = FormSection::class;
    protected $relation = 'questions';


    // funcion desdepues de insertar un registro
 protected function afterStore(Request $request, $parentEntity, $entity)
    {
        //agregamos question options
        $questionOption = $entity->questionOptions()->create([
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
        return ['name'];
    }

    public function filterableBy(): array
    {
        return ['user_id', 'id'];
    }
    public function sortableBy(): array
    {
        return ['order'];
    }


    protected function request()
    {
        return QuestionRequest::class;
    }

    public function includes(): array
    {
        return ['categoryQuestion','questionOptions'];
    }

    public function duplicateQuestion(Request $request)
    {
        $data = $request->all();

        // Crear la nueva pregunta sin el ID original
        $newQuestion = Question::create([
            'category_question_id' => $data['category_question_id'],
            'form_section_id' => $data['form_section_id'],
            'type_control' => $data['type_control'],
            'name' => $data['name'],
            'message_error' => $data['message_error'],
            'order' => $data['order'],
            'is_required' => $data['is_required'],
            'description' => $data['description'],
            'weight' => $data['weight'],
            'user_id' => auth()->user()->id,
        ]);

        // Si hay opciones de pregunta, duplicarlas también
        if (isset($data['question_options']) && is_array($data['question_options'])) {
            foreach ($data['question_options'] as $optionData) {
                $newQuestion->questionOptions()->create([
                    'question_title' => $optionData['question_title'],
                    'is_correct' => $optionData['is_correct'],
                    'weight' => $optionData['weight'],
                    'user_id' => auth()->user()->id,
                ]);
            }
        }

        return response()->json([
            'message' => 'Pregunta duplicada exitosamente',
            'data' => $newQuestion->load(['categoryQuestion', 'questionOptions'])
        ], 201);
    }
}
