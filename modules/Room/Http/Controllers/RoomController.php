<?php

namespace Modules\Room\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Room\Actions\DeleteRoomAction;
use Modules\Room\Actions\RoomAction;
use Modules\Room\DTO\RoomData;
use Modules\Room\Http\Requests\RoomRequest;
use Modules\Room\Models\Room;

class RoomController extends Controller
{
    public function __construct(private readonly RoomAction $roomAction,
        private readonly DeleteRoomAction $deleteRoomAction)
    {
    }

    public function index()
    {
        $rooms = Room::paginate(10);
        return view('room::index', compact('rooms'));
    }

    public function create()
    {
        return view('room::create');
    }

    public function store(RoomRequest $request)
    {
        $this->upsert($request, new Room());

        return redirect()->route('rooms.index')->with('success', 'Sala creada con éxito.');

    }

    public function edit(Room $room)
    {
        return view('room::edit', compact('room'));
    }

    public function update(RoomRequest $request, Room $room)
    {
        $this->upsert($request, $room);

        return redirect()->route('rooms.index')->with('success', 'Sala actualizada con éxito.');
    }

    public function destroy(Room $room)
    {
        $deleted = $this->deleteRoomAction->execute($room);

        if (!$deleted) {
            return redirect()->route('rooms.index')->with('error', 'No se puede eliminar la sala porque tiene reservaciones asociadas.');
        }

        return redirect()->route('rooms.index')->with('success', 'Sala eliminada con éxito.');

    }

    public function upsert(RoomRequest $request, Room $room)
    {
        $roomData =  new RoomData(...$request->validated());
        $this->roomAction->execute($roomData, $room);
    }
}
