<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'shelter' => 'required|exists:opcion_consultas,id',  // 'opcion_consultas' es el nombre de la tabla relacionada
            'message' => 'required|string|max:1000',
        ];
    }

    /**
     * Obtén los mensajes de error personalizados.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstName.required' => 'El nombre es obligatorio.',
            'lastName.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'shelter.required' => 'Debe seleccionar una opción.',
            'message.required' => 'El mensaje es obligatorio.',
        ];
    }
}
