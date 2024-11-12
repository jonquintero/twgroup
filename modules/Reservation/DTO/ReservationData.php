<?php

namespace Modules\Reservation\DTO;

readonly class ReservationData
{
    public function __construct(

           public int $room_id,
           public string $reservation_date,

    )
   {

   }
}
