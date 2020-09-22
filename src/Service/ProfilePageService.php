<?php

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
        $fileName = $request->files->get('photo')->getClientOriginalName();
        $path = "../public/uploads/";
        $request->files->get('photo')->move($path, $fileName);

        $user = $this->roomRepository->find($this->security->getUser()->getId());
        $user->setImage($path . $fileName);

        return $user;
        $this->em->persist($user);
        $this->em->flush();


    }
}