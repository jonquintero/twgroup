<?php

namespace Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Reservation\Actions\GetReservationsAction;
use Modules\Reservation\Http\Requests\UpdateReservationStatusRequest;
use Modules\Reservation\Models\Reservation;
use Modules\Room\Models\Room;

class AdminReservationController extends Controller
{
    public function __construct(private readonly GetReservationsAction $getReservationsAction)
    {
    }

    public function index(Request $request)
    {
        $data = $this->getReservationsAction->execute($request);

        return view('reservation::index-manage', $data);
    }

    public function update(UpdateReservationStatusRequest $request, Reservation $reservation)
    {
        $reservation->update(['status' => $request->status]);

        return redirect()->route('admin.reservations.index')->with('success', 'El estado de la reservación ha sido actualizado.');
    }
}
