<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class RegisterController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function registerShow(Request $request)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        if (null != $request->get('doGo')) {
            if ($request->get('password') !== $request->get('password_confirmation')) {
                return $this->render('register/index.html.twig', [
                    'controller_name' => 'RegisterController',
                    'error' => 'Паролі не співпадають',
                ]);
            }
            $user = new User($request->get('email'), $request->get('name'));
            $user->setPassword($this->passwordEncoder->encodePassword($user, $request->get('password')));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
        ]);
    }
}
