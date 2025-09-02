<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class ScoreNormRequest extends Request
{
    public function storeRules(): array
    {
        return [
           'category_question_id' => 'required|exists:category_questions,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'min_score' => 'required|integer|min:0',
            'max_score' => 'required|integer|min:0',
            'html_color' => 'nullable|string|max:20',
            'invalidation_score' => 'nullable|integer|min:0',
            'user_id' => 'nullable|numeric'
        ];
    }
}
