<?php

namespace Modules\Reservation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Reservation\Models\Reservation;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => [
                'required',
                'exists:rooms,id',
            ],
            'reservation_date' => [
                'required',
                'date',
                'after:now',
                function ($attribute, $value, $fail) {

                    $startTime = Carbon::parse($value);
                    $endTime = $startTime->copy()->addHour();

                    $conflictingReservation = Reservation::where('room_id', $this->room_id)
                        ->where(function ($query) use ($startTime, $endTime) {
                            $query->whereBetween('reservation_date', [$startTime, $endTime])
                                ->orWhere(function ($query) use ($startTime, $endTime) {

                                    $query->where('reservation_date', '<', $endTime)
                                        ->whereRaw('DATE_ADD(reservation_date, INTERVAL 1 HOUR) > ?', [$startTime]);
                                });
                        })
                        ->exists();

                    if ($conflictingReservation) {
                        $fail('La sala ya está reservada en ese horario.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'room_id.required' => 'La sala es obligatoria.',
            'room_id.exists' => 'La sala seleccionada no existe.',
            'reservation_date.required' => 'La fecha y hora de la reservación es obligatoria.',
            'reservation_date.date' => 'La fecha y hora de la reservación no es válida.',
            'reservation_date.after' => 'La fecha y hora de la reservación debe ser futura.',
        ];
    }
}
