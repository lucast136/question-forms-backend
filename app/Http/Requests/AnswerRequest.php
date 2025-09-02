<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class AnswerRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'question_option_id' => 'required|integer|exists:question_options,id',
            'client_id' => 'required|integer|exists:clients,id',
            'user_id_qualifier' => 'nullable|integer|exists:users,id',
            'qualified_score' => 'nullable|numeric|min:0|max:100',
            'score_auto' => 'nullable|numeric|min:0|max:100',
            'ip_client' => 'nullable|ip',
            'observation' => 'nullable|string|max:255',
            'user_id' => 'nullable|numeric'
        ];
    }


    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'question_option_id.required' => 'La opción de pregunta es obligatoria.',
            'question_option_id.exists' => 'La opción de pregunta seleccionada no existe.',
            'client_id.required' => 'El cliente es obligatorio.',
            'client_id.exists' => 'El cliente seleccionado no existe.',
            'user_id_qualifier.exists' => 'El usuario calificador seleccionado no existe.',
            'qualified_score.numeric' => 'El puntaje calificado debe ser un número.',
            'qualified_score.min' => 'El puntaje calificado debe ser al menos 0.',
            'qualified_score.max' => 'El puntaje calificado no puede ser mayor a 100.',
            'score_auto.numeric' => 'El puntaje automático debe ser un número.',
            'score_auto.min' => 'El puntaje automático debe ser al menos 0.',
            'score_auto.max' => 'El puntaje automático no puede ser mayor a 100.',
            'ip_client.ip' => 'La IP del cliente debe tener un formato válido.',
            'observation.max' => 'La observación no puede exceder los 255 caracteres.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'question_option_id' => 'opción de pregunta',
            'client_id' => 'cliente',
            'user_id_qualifier' => 'usuario calificador',
            'qualified_score' => 'puntaje calificado',
            'score_auto' => 'puntaje automático',
            'ip_client' => 'IP del cliente',
            'observation' => 'observación',
        ];
    }
}
