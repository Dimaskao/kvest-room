<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Room;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * This class create fake comments data for DB
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class CommentFixture extends AbstractFixture implements DependentFixtureInterface
{
    private const COMMENTS_COUNT = 40;
    private const ROOMS_COUNT = 9;
    private const USERS_COUNT = 9;

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::COMMENTS_COUNT; ++$i) {
            $room = $this->getRandomRoom();
            $user = $this->getRandomUser();
            $comment = $this->createComment($room, $user);

            $manager->persist($comment);
        }

        $manager->flush();
    }

    private function createComment(Room $room, User $user): Comment
    {
        return new Comment($this->generateCommentText(), $room, $user);
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

    private function getRandomUser(): User
    {
        $key = \rand(0, self::USERS_COUNT);

        return $this->getReference('user_'.$key);
    }

    public function getDependencies()
    {
        return [
            RoomFixture::class,
            UserFixture::class,
        ];
    }
}
