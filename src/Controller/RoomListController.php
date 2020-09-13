<?php

namespace App\Controller;

use App\Service\RoomListProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering roomList page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class RoomListController extends AbstractController
{
    private RoomListProviderInterface $roomListProvider;

    public function __construct(RoomListProviderInterface $roomListProvider)
    {
        $this->roomListProvider = $roomListProvider;
    }

    /**
     * @Route("/rooms", methods={"GET"}, name="app_rooms")
     */
    public function RoomList(): Response
    {
        $roomList = $this->roomListProvider->getRoomList();

        return $this->render('roomList/roomList.html.twig', [
            'roomList' => $roomList,
        ]);
    }
}
