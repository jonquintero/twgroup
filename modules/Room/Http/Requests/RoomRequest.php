<?php

namespace Modules\Room\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('rooms')->ignore($this->route('room')),
            ],
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la sala es obligatorio.',
            'name.string' => 'El nombre de la sala debe ser un texto válido.',
            'name.max' => 'El nombre de la sala no debe exceder los 255 caracteres.',
            'name.unique' => 'El nombre de la sala ya está en uso.',
            'description.string' => 'La descripción debe ser un texto válido.',
        ];
    }
}
