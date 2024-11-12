<?php

namespace Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Reservation\Actions\ReservationAction;
use Modules\Reservation\DTO\ReservationData;
use Modules\Reservation\Http\Requests\ReservationRequest;
use Modules\Reservation\Models\Reservation;
use Modules\Room\Models\Room;

class ReservationController extends Controller
{
    public function __construct(private readonly  ReservationAction $reservationAction)
    {
    }

    public function index()
    {
        $reservations = Auth::user()->reservations()->with('room')->paginate();
        return view('reservation::index', compact('reservations'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('reservation::create', compact('rooms'));
    }

    public function store(ReservationRequest $request)
    {
        $this->upsert($request, new Reservation());

        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');

    }

    public function upsert(ReservationRequest $request, Reservation $reservation)
    {
        $reservationData = new ReservationData(...$request->validated());

        $this->reservationAction->execute($reservationData, $reservation);
    }

    // Otros métodos del controlador
}
