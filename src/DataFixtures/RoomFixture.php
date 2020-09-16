<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Persistence\ObjectManager;

final class RoomFixture extends AbstractFixture
{
    private const ROOMS_COUNT = 10;
    private const PEOPLE_AND_TIME_INFO = '2-4|60';

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::ROOMS_COUNT; ++$i) {
            $room = $this->createRoom();

            if ($this->faker->boolean(80)) {
                $room->makeAvailable();
            }
            $manager->persist($room);
        }

        $manager->flush();
    }

    public function createRoom(): Room
    {
        $name = $this->faker->words(
            $this->faker->numberBetween(1, 4),
            true
        );

        return new Room(
            $name,
            $this->faker->imageUrl(),
            $this->faker->text,
            self::PEOPLE_AND_TIME_INFO
        );
    }
}
