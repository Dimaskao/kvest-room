<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class ProfilePageService implements ProfilePageServiceInterface
{
    private Security $security;
    private EntityManagerInterface $em;
    private UserRepository $roomRepository;

    public function __construct(Security $security, EntityManagerInterface $em, UserRepository $roomRepository)
    {
        $this->security = $security;
        $this->roomRepository = $roomRepository;
        $this->em = $em;
    }

    public function savePhoto(Request $request)
    {
    }
}
