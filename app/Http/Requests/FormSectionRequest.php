<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class FormSectionRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'form_id' => 'required|numeric|exists:forms,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|numeric',
            'user_id' => 'nullable|numeric'
        ];
    }
}
