<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FormCompleteController extends Controller
{
    use DisableAuthorization;

    protected $model = Form::class;

    public function limit(): int
    {
        return 50;
    }
    public function filterableBy(): array
    {
        return ['id'];
    }
    public function includes(): array
    {
        return [
            'categoryForm',
            'categoryForm.scoreNorms',
            'categoryForm.scoreNorms.categoryQuestion',
            'formSections',
            'formSections.questions',
            'formSections.questions.categoryQuestion',
            'formSections.questions.questionOptions',
            'formSections.questions.questionOptions.answers'
            ];
    }
    public function aggregates() : array
    {
        return ['questions'];
    }


/**
 * Obtener formulario con estadísticas del usuario
 */
public function getWithUserStats(Request $request)
{
    $clientId = $request->input('client_id');
    $formId = $request->input('form_id');

    if (!$clientId) {
        return response()->json(['error' => 'client_id es requerido'], 400);
    }
    if (!$formId) {
        return response()->json(['error' => 'form_id es requerido'], 400);
    }

    $form = Form::findOrFail($formId);

    // ✅ Obtener estadísticas del usuario
    $userStats = [
        'total_questions' => $form->questions()->count(),
        'answered_questions' => $form->countUserAnswers($clientId),
        'completion_percentage' => $form->getCompletionPercentage($clientId),
        'is_completed' => $form->isCompletedByUser($clientId),
    ];

    return response()->json([
        'data' => $form,
        'user_stats' => $userStats
    ]);
}

}
