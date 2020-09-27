<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Exception\RegistrationException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterService implements RegisterServiceInterface
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
        $this->userRepository = $userRepository;
    }

    public function register(string $name, string $email, string $password, string $password_confirm): void
    {
        if ($password !== $password_confirm) {
            throw new RegistrationException('Паролі не співпадають');
        }
        if ($this->userRepository->findOneBy(['email' => $email])) {
            throw new RegistrationException('Email already exists');
        }
        $user = new User($email, $name);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();
    }
}
