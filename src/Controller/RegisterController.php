<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\RegistrationException;
use App\Service\RegisterServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class RegisterController extends AbstractController
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private RegisterServiceInterface $registerService;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, RegisterServiceInterface $registerService)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->registerService = $registerService;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function registerShow(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        if (null != $request->get('doGo')) {
            $name = $request->get('name');
            $email = $request->get('email');
            $password = $request->get('password');
            $password_confirm = $request->get('password_confirmation');
            try {
                $this->registerService->register($name, $email, $password, $password_confirm);
            } catch (RegistrationException $e) {
                return $this->showError($e->getMessage());
            }

            return $this->redirect($this->generateUrl('app_login'));
        }

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
        ]);
    }

    private function showError($message): Response
    {
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'error' => $message,
        ]);
    }
}
