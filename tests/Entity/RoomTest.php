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
        $peopleAndTimeInfo = '2-4|60';

        $room = new Room($name, $image, $description, $peopleAndTimeInfo);

        static::assertEquals($name, $room->getName());
        static::assertEquals($image, $room->getImage());
        static::assertEquals($description, $room->getDescription());
        static::assertEquals($peopleAndTimeInfo, $room->getPeopleAndTimeInfo());
    }

    public function testPublish(): void
    {
        $name = 'This is test';
        $image = 'image.jpg';
        $description = 'room';
        $peopleAndTimeInfo = '2-4|60';

        $room = new Room($name, $image, $description, $peopleAndTimeInfo);

        $room->makeAvailable();

        static::assertEquals(true, $room->isAvailable());
    }
}
