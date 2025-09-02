<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class ClientRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'last_name' => 'required|string|max:80',
            'first_name' => 'required|string|max:80',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:Masculino,Femenino',
            'age' => 'required|integer|min:1|max:120',
            'province' => 'required|string|max:20',
            'user_id' => 'nullable|numeric'
        ];

    }

    // /**
    //  * Get custom error messages for validator errors.
    //  *
    //  * @return array<string, string>
    //  */
    // public function messages(): array
    // {
    //     return [
    //         'last_name.required' => 'Los apellidos son obligatorios.',
    //         'last_name.max' => 'Los apellidos no pueden exceder los 80 caracteres.',
    //         'first_name.required' => 'Los nombres son obligatorios.',
    //         'first_name.max' => 'Los nombres no pueden exceder los 80 caracteres.',
    //         'email.required' => 'El email es obligatorio.',
    //         'email.email' => 'El email debe tener un formato válido.',
    //         'email.unique' => 'Este email ya está registrado.',
    //         'gender.required' => 'El género es obligatorio.',
    //         'gender.in' => 'El género debe ser masculino o femenino.',
    //         'age.required' => 'La edad es obligatoria.',
    //         'age.integer' => 'La edad debe ser un número entero.',
    //         'age.min' => 'La edad debe ser al menos 1 año.',
    //         'age.max' => 'La edad no puede ser mayor a 120 años.',
    //         'province.required' => 'La provincia es obligatoria.',
    //         'province.max' => 'La provincia no puede exceder los 20 caracteres.',
    //     ];
    // }

    // /**
    //  * Get custom attributes for validator errors.
    //  *
    //  * @return array<string, string>
    //  */
    // public function attributes(): array
    // {
    //     return [
    //         'last_name' => 'apellidos',
    //         'first_name' => 'nombres',
    //         'email' => 'correo electrónico',
    //         'gender' => 'género',
    //         'age' => 'edad',
    //         'province' => 'provincia',
    //     ];
    // }
}
