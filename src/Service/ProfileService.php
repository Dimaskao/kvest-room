<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Security;

/**
 * This class get data for profile page.
 * Also saves photo and removes profile.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class ProfileService implements ProfileServiceInterface
{
    private Security $security;
    private EntityManagerInterface $em;
    private UserRepository $roomRepository;
    private ParameterBagInterface $parameters;

    public function __construct(Security $security, EntityManagerInterface $em, UserRepository $roomRepository, ParameterBagInterface $parameters)
    {
        $this->security = $security;
        $this->roomRepository = $roomRepository;
        $this->em = $em;
        $this->parameters = $parameters;
    }

    public function savePhoto(string $fileName, $photo)
    {
        $pathToSave = $this->parameters->get('app.save_photo_path');
        $pathIntoDb = $this->parameters->get('app.photo_into_db');
        $photo->move($pathToSave, $fileName);

        $user = $this->security->getUser();
        $user->setImage($pathIntoDb.$fileName);

        $this->em->persist($user);
        $this->em->flush();
    }

    public function removeProfile()
    {
        $user = $this->security->getUser();

        $this->em->remove($user);
        $this->em->flush();
    }
}
