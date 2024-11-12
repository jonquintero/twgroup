<?php

namespace Modules\Room\Actions;

use Modules\Room\DTO\RoomData;
use Modules\Room\Models\Room;

class RoomAction
{
     public function execute(RoomData $roomData, Room $room): void
    {
       $room->name = $roomData->name;
       $room->description = $roomData->description;
       $room->save();
    }
}
