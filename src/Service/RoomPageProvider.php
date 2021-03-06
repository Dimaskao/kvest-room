<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\RoomDTO;
use App\Repository\RoomRepository;

/**
 * This class get data for room page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class RoomPageProvider implements RoomPageProviderInterface
{
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getRoomByField($field): RoomDTO
    {
        $room = $this->roomRepository->getRoomFromDB($field);

        return $room->getRoom();
    }
}
