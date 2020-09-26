<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AdminServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering admin page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 * @IsGranted("ROLE_ADMIN")
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
            $name = $request->get('name');
            $photo = $request->files->get('photo');
            $description = $request->get('description');
            $isAvailable = $request->get('available');
            $peopleAndTimeInfo = $request->get('peopleAndTimeInfo');

            $this->adminService->editRoom((int)$roomId, $name, $photo, $description, (bool)$isAvailable, $peopleAndTimeInfo);

            return $this->redirectToRoute('app_admin');
        }
        $room = $this->adminService->getRooms((int)$roomId);

        return $this->render('admin/admin.html.twig', [
            'roomToEdit' => $room,
        ]);
    }

    /**
     * @Route("/admin/add", methods={"POST"}, name="app_admin_add")
     */
    public function add(Request $request)
    {
        if (null !== $request->get('confirm_add')) {
            $fileName = $request->files->get('photo')->getClientOriginalName();
            $photo = $request->files->get('photo');
            $name = $request->get('name');
            $description = $request->get('description');
            $isAvailable = $request->get('available');
            $peopleAndTimeInfo = $request->get('peopleAndTimeInfo');

            $this->adminService->addRoom($fileName, $photo, $name, $description, $peopleAndTimeInfo, (bool)$isAvailable);

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/admin.html.twig', [
            'addRoom' => true,
        ]);
    }
}
