<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\EntityNotFoundException;
use App\Service\RoomPageProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Rendering room page.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
class RoomPageController extends AbstractController
{
    private RoomPageProviderInterface $roomProvider;

    public function __construct(RoomPageProviderInterface $roomProvider)
    {
        $this->roomProvider = $roomProvider;
    }

    /**
     * @Route("/room/{id}", requirements={"id"="\d+"}, methods={"GET"}, name="app_room")
     */
    public function getRoomById($id): Response
    {
        try {
            $room = $this->roomProvider->getRoomByIdFromDB($id);
        } catch (EntityNotFoundException $e) {
            throw $this->createNotFoundException($e->getMessage(), $e);
        }

        return $this->render('room/room.html.twig', [
            'room' => $room,
        ]);
    }
}
