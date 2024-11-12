<?php

namespace Modules\Room\Actions;

use Modules\Room\Models\Room;

class DeleteRoomAction
{
    public function execute(Room $room): bool
    {
        if ($room->reservations()->exists()) {
            return false;
        }

        $room->delete();
        return true;
    }
}
