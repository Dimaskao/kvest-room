<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AdminServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering admin page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class AdminController extends AbstractController
{
    private AdminServiceInterface $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * @Route("/admin", methods={"GET"}, name="app_admin")
     */
    public function admin(): Response
    {
        $rooms = $this->adminService->getRooms();

        return $this->render('admin/admin.html.twig', [
            'rooms' => $rooms->getRoomList(),
        ]);
    }

    /**
     * @Route("/admin/edit", methods={"POST"}, name="app_admin_edit")
     */
    public function edit(Request $request)
    {
        $roomId = $request->get('room');

        if (null !== $request->get('confirm_edit')) {
            $this->adminService->editRoom($request, $roomId);
            $this->redirectToRoute('app_admin');
        }

        $room = $this->adminService->getRooms($roomId);

        return $this->render('admin/admin.html.twig', [
            'roomToEdit' => $room,
        ]);
    }
}
