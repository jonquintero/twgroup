<?php

namespace Modules\Reservation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia esto si quieres agregar lógica de autorización
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:Accepted,Rejected',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser "Accepted" o "Rejected".',
        ];
    }
}
