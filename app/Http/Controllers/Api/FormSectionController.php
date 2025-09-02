<?php

namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\RelationController;
use App\Models\Form;
use App\Http\Requests\FormSectionRequest;
use App\Models\CategoryQuestion;
use App\Models\FormSection;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\Request;

class FormSectionController extends RelationController
{
    use DisableAuthorization;

    protected $model = Form::class;
    protected $relation = 'formSections';


    // funcion desdepues de insertar un registro
 protected function afterStore(Request $request, $parentEntity, $entity)
    {
        //obtenemos la primera categoria de pregunta del usuario logueado
        // $categoryQuestion=CategoryQuestion::where('user_id', auth()->user()->id)->first();
        //agregamos una pregunta a las seccion
        $question=$entity->questions()->create([
            'category_question_id' => null,
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
        return ['title'];
    }
    public function sortableBy(): array
    {
        return ['order'];
    }

    public function filterableBy(): array
    {
        return ['user_id','id'];
    }

    protected function request()
    {
        return FormSectionRequest::class;
    }

    public function includes(): array
    {
        return ['questions','questions.categoryQuestion','questions.questionOptions'];
    }

    public function duplicateSection(Request $request)
    {
        $data = $request->all();

        // Crear la nueva sección sin el ID original
        $newSection = FormSection::create([
            'form_id' => $data['form_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'order' => $data['order'],
            'user_id' => auth()->user()->id,
        ]);

        // Si hay preguntas, duplicarlas también
        if (isset($data['questions']) && is_array($data['questions'])) {
            foreach ($data['questions'] as $questionData) {
                // Crear la nueva pregunta
                $newQuestion = $newSection->questions()->create([
                    'category_question_id' => $questionData['category_question_id'],
                    'type_control' => $questionData['type_control'],
                    'name' => $questionData['name'],
                    'message_error' => $questionData['message_error'],
                    'order' => $questionData['order'],
                    'is_required' => $questionData['is_required'],
                    'description' => $questionData['description'],
                    'weight' => $questionData['weight'],
                    'user_id' => auth()->user()->id,
                ]);

                // Si hay opciones de pregunta, duplicarlas también
                if (isset($questionData['question_options']) && is_array($questionData['question_options'])) {
                    foreach ($questionData['question_options'] as $optionData) {
                        $newQuestion->questionOptions()->create([
                            'question_title' => $optionData['question_title'],
                            'is_correct' => $optionData['is_correct'],
                            'weight' => $optionData['weight'],
                            'user_id' => auth()->user()->id,
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'message' => 'Sección duplicada exitosamente',
            'data' => $newSection->load(['questions', 'questions.categoryQuestion', 'questions.questionOptions'])
        ], 201);
    }
}
