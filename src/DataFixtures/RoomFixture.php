<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Persistence\ObjectManager;

/**
 * This class create fake rooms data for DB.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class RoomFixture extends AbstractFixture
{
    private const ROOMS_COUNT = 10;
    private const PEOPLE_COUNT = '2-4';
    private const TIME_COUNT = 60;

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::ROOMS_COUNT; ++$i) {
            $room = $this->createRoom();

            if ($this->faker->boolean(80)) {
                $room->makeAvailable();
            }
            $this->addReference('room_'.$i, $room);
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
            self::PEOPLE_COUNT,
            self::TIME_COUNT,
        );
    }
}
