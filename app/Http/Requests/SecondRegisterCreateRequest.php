<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecondRegisterCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'p_nombre' => ['required', 'string', 'max:30'],
            's_nombre' => ['string', 'max:30', 'nullable'],
            'p_apellido' => ['required', 'string', 'max:30'],
            's_apellido' => ['string', 'max:30', 'nullable'],
            'rut' => ['required', 'string', 'max:12'],
        ];
    }

    public function messages()
    {
        return [
            'p_nombre.required' => 'El :attribute es obligatorio.',
            'p_nombre.max' => 'El :attribute debe ser de máximo 30 caracteres.',
            's_nombre.max' => 'El :attribute debe ser de máximo 30 caracteres.',
            'p_apellido.required' => 'El :attribute es obligatorio.',
            'p_apellido.max' => 'El :attribute debe ser de máximo 30 caracteres.',
            's_apellido.max' => 'El :attribute debe ser de máximo 30 caracteres.',
            'rut.required' => 'El :attribute es obligatorio.',
            'rut.max' => 'El :attribute debe ser de máximo 12 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'p_nombre' => 'primer nombre',
            's_nombre' => 'segundo nombre',
            'p_apellido' => 'primer apellido',
            's_apellido' => 'segundo apellido',
            'rut' => 'RUT',
        ];
    }
}
