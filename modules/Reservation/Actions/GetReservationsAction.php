<?php

namespace Modules\Reservation\Actions;

use Modules\Reservation\Models\Reservation;
use Modules\Room\Models\Room;
use Illuminate\Http\Request;

class GetReservationsAction
{
    public function execute(Request $request): array
    {
        $rooms = Room::all();

        $reservations = Reservation::query()
            ->with('room', 'user')
            ->when($request->room_id, function ($query, $roomId) {
                $query->where('room_id', $roomId);
            })
            ->orderBy('reservation_date', 'desc')
            ->paginate();

        return compact('reservations', 'rooms');
    }
}
