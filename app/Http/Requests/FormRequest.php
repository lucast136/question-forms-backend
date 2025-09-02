<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class FormRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'published_at' => 'nullable|date',
            'archived_at' => 'nullable|date',
            'user_id' => 'required|numeric'
        ];
    }
}
