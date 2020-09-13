<?php

namespace App\Service;

use App\Collection\RoomList;
use App\DTO\Room;
use Faker\Factory;
use Faker\Generator;

/**
 * Generate fake rooms.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class RoomListFakeProvider implements RoomListProviderInterface
{
    private const ROOMS_COUNT = 6;
    private const PEOPLE_AND_TIME_INFO = '2-4|60';

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function getRoomList(): RoomList
    {
        $roomList = [];

        for ($i = 0; $i < self::ROOMS_COUNT; ++$i) {
            $roomList[] = $this->createRoom($i + 1);
        }

        return new RoomList($roomList);
    }

    private function createRoom($id): Room
    {
        $name = $this->faker->words(
            $this->faker->numberBetween(1, 4),
            true
        );

        return new Room(
            $id,
            $name,
            $this->faker->imageUrl(),
            $this->faker->text,
            self::PEOPLE_AND_TIME_INFO
        );
    }
}
