<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * This class get data for profile page.
 * Also saves photo and removes profile.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class ProfilePageService implements ProfilePageServiceInterface
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
        $path = '../public/uploads/';
        $request->files->get('photo')->move($path, $fileName);

        $user = $this->roomRepository->find($this->security->getUser()->getId());
        $user->setImage('uploads/'.$fileName);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function removeProfile(Request $request)
    {
        $user = $this->security->getUser();
        $comments = $user->getComments()->toArray();
        foreach ($comments as $comment) {
            $this->em->remove($comment);
        }
        $this->em->remove($user);
        $this->em->flush();
        $request->getSession()->invalidate();
    }
}
