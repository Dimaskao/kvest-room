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
    private ProfilePageServiceInterface $profilePageService;
    private EntityManagerInterface $em;
    private UserRepository $roomRepository;

    public function __construct(ProfilePageServiceInterface $profilePageService, EntityManagerInterface $em, UserRepository $roomRepository)
    {
        $this->profilePageService = $profilePageService;
        $this->roomRepository = $roomRepository;
        $this->em = $em;
    }

    /**
     * @Route("/profile", methods={"GET"}, name="app_profile")
     */
    public function account(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('profile/profile.html.twig');
    }

    /**
     * @Route("/profile/save", methods={"POST"}, name="app_profile_save_image")
     */
    public function saveImage(Request $request): RedirectResponse
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_home');
        }
        if (null == $request->files->get('photo')) {
            return $this->redirectToRoute('app_profile');
        }

        $this->profilePageService->savePhoto($request);

        return $this->redirectToRoute('app_profile');
    }

    /**
     * @Route("/profile/remove", methods={"GET"}, name="app_profile_remove")
     */
    public function removeProfile(Request $request)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_home');
        }
        $this->profilePageService->removeProfile($request);
        $this->get('security.token_storage')->setToken(null);
        return $this->redirectToRoute('app_logout');
    }
}
