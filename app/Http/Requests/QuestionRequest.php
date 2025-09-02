<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class QuestionRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'category_question_id' => 'nullable|numeric|exists:category_questions,id',
            'form_section_id' => 'required|numeric|exists:form_sections,id',
            'type_control' => 'required|string|max:255',
            'name' => 'required|string',
            'message_error' => 'nullable|string',
            'order' => 'required|numeric',
            'is_required' => 'required|boolean',
            'description' => 'nullable|string',
            'weight' => 'required|numeric',
            'user_id' => 'nullable|numeric'
        ];
    }
}
