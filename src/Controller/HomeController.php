<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering home page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="app_home")
     */
    public function home()
    {
        return $this->render('home/home.html.twig');
    }

}
