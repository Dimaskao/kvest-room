<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Room;
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    public function testCreate(): void
    {
        $name = 'This is test';
        $image = 'image.jpg';
        $description = 'room';
        $peopleCount = '2-4';
        $timeCount = 60;

        $room = new Room($name, $image, $description, $peopleCount, $timeCount);

        static::assertEquals($name, $room->getName());
        static::assertEquals($image, $room->getImage());
        static::assertEquals($description, $room->getDescription());
        static::assertEquals($peopleCount, $room->getPeopleCount());
        static::assertEquals($timeCount, $room->getTimeCount());
        static::assertEquals(false, $room->isAvailable());
    }

    public function testMakeAvailable(): void
    {
        $name = 'This is test';
        $image = 'image.jpg';
        $description = 'room';
        $peopleCount = '2-4';
        $timeCount = 60;

        $room = new Room($name, $image, $description, $peopleCount, $timeCount);

        $room->makeAvailable();

        static::assertTrue($room->isAvailable());
    }
}
