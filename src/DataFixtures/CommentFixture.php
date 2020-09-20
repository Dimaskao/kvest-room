<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Room;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixture extends AbstractFixture implements DependentFixtureInterface
{
    private const COMMENTS_COUNT = 50;
    private const ROOMS_COUNT = 9;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::COMMENTS_COUNT; ++$i) {
            $room = $this->getRandomRoom();
            $comment = $this->createComment($room);

            $manager->persist($comment);
        }

        $manager->flush();
    }

    private function createComment($room): Comment
    {
        return new Comment($this->generateCommentText(), $room);
    }

    private function getRandomRoom(): Room
    {
        $key = \rand(0, self::ROOMS_COUNT);

        return $this->getReference('room_'.$key);
    }

    private function generateCommentText(): string
    {
        return $this->faker->words(
            $this->faker->numberBetween(3, 7),
            true
        );
    }

    public function getDependencies()
    {
        return [
            RoomFixture::class,
        ];
    }
}
