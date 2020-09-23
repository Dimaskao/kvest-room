<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\ProfilePageServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering profile page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class ProfileController extends AbstractController
{
    private ProfilePageServiceInterface $profileProvider;
    private EntityManagerInterface $em;
    private UserRepository $roomRepository;

    public function __construct(ProfilePageServiceInterface $profileProvider, EntityManagerInterface $em, UserRepository $roomRepository)
    {
        $this->profileProvider = $profileProvider;
        $this->roomRepository = $roomRepository;
        $this->em = $em;
    }

    /**
     * @Route("/profile", methods={"GET"}, name="app_profile")
     */
    public function account(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profile/profile.html.twig');
    }

    /**
     * @Route("/profile/save", methods={"POST"}, name="app_profile_save_image")
     */
    public function saveImage(Request $request): RedirectResponse
    {
        if (null == $request->files->get('photo')) {
            return $this->redirectToRoute('app_profile');
        }

        $fileName = $request->files->get('photo')->getClientOriginalName();
        $path = '../public/uploads/';
        $request->files->get('photo')->move($path, $fileName);

        $user = $this->roomRepository->find($this->getUser()->getId());
        $user->setImage('uploads/'.$fileName);

        $this->em->persist($user);
        $this->em->flush();

        return $this->redirectToRoute('app_profile');
    }
}
