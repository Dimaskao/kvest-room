<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserFixture extends AbstractFixture
{
    private const USERS_COUNT = 10;

    protected UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::USERS_COUNT; ++$i) {
            $user = $this->createUser($i);

            $this->addReference('user_'.$i, $user);
            $manager->persist($user);
        }

        $admin = new User('admin@dev.com', 'admin');
        $admin->setPassword($this->passwordEncoder->encodePassword($user, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }

    private function createUser($i): User
    {
        $user = new User(
            $i.'@mail',
            $this->faker->name(),
        );
        $user->setPassword($this->passwordEncoder->encodePassword($user, '111'));
        $user->setImage($this->faker->imageUrl());

        return $user;
    }
}
