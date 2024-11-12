<?php

namespace Modules\Reservation\Actions;

use Modules\Reservation\DTO\ReservationData;
use Modules\Reservation\Models\Reservation;

class ReservationAction
{
     public function execute(ReservationData $reservationData, Reservation $reservation): void
    {
        $reservation->user_id = auth()->id();
        $reservation->room_id = $reservationData->room_id;
        $reservation->reservation_date = $reservationData->reservation_date;
        $reservation->status = Reservation::STATUS_PENDING;
       $reservation->save();

    }
}
