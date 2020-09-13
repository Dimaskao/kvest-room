<?php

namespace App\Service;

use App\Collection\RoomList;
use App\DTO\Room;
use App\Repository\RoomRepository;

/**
 * This class get data for roomList page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class RoomListProvider implements RoomListProviderInterface
{
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getRoomList(): RoomList
    {
        $result = $this->roomRepository->getRoomList();
        $roomList = [];
        foreach ($result as $room) {
            $roomList[] = new Room($room['id'], $room['name'], $room['image']);
        }

        return new RoomList($roomList);
    }
}
