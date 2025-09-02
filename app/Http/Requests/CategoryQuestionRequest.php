<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class CategoryQuestionRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'nullable|numeric'
        ];
    }
}
