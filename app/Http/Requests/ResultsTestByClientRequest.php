<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class ResultsTestByClientRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'form_id' => 'required|exists:forms,id',
            'score_norm_id' => 'required|exists:score_norms,id',
            'client_id' => 'required|exists:clients,id',
            'score' => 'required|numeric|min:0|max:100',
            'total_score' => 'required|numeric|min:0|max:100'
        ];
    }
}
