<?php

namespace Modules\Room\DTO;

readonly class RoomData
{
    public function __construct(
           public string $name,
           public ?string $description,
    )
   {

   }
}
