<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class QuestionOptionRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'question_title' => 'required|string',
            'is_correct' => 'required|boolean',
            'weight' => 'nullable|numeric',
            'user_id' => 'nullable|numeric'
        ];
    }
}
