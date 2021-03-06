<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering home page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class HomeController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="app_home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }
}
