<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class CategoryFormRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|numeric'
        ];
    }
}
