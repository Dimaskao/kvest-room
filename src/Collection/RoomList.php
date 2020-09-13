<?php

namespace App\Collection;

/**
 * Storage information for roomList page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class RoomList
{
    private array $roomList;

    public function __construct(array $roomList)
    {
        $this->roomList = $roomList;
    }

    public function getRoomList(): array
    {
        return $this->roomList;
    }

    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->roomList);
    }
}
