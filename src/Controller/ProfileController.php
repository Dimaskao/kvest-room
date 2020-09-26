<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\ProfileServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
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
    private ProfileServiceInterface $profilePageService;
    private UserRepository $roomRepository;
    private ParameterBagInterface $parameters;

    public function __construct(ProfileServiceInterface $profilePageService, UserRepository $roomRepository, ParameterBagInterface $parameters)
    {
        $this->profilePageService = $profilePageService;
        $this->roomRepository = $roomRepository;
        $this->parameters = $parameters;
    }

    /**
     * @Route("/profile", methods={"GET"}, name="app_profile")
     */
    public function account(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

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

        $fileName = $request->files->get('photo')->getClientOriginalName();
        $photo = $request->files->get('photo');

        $this->profilePageService->savePhoto($fileName, $photo);

        return $this->redirectToRoute('app_profile');
    }

    /**
     * @Route("/profile/remove", methods={"GET"}, name="app_profile_remove")
     */
    public function removeProfile(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $this->profilePageService->removeProfile();

        $this->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();

        return $this->redirectToRoute('app_logout');
    }
}
