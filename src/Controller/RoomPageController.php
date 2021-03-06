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
final class RoomPageController extends AbstractController
{
    private RoomPageProviderInterface $roomProvider;

    public function __construct(RoomPageProviderInterface $roomProvider)
    {
        $this->roomProvider = $roomProvider;
    }

    /**
     * @Route("/room/{field}", methods={"GET"}, name="app_room")
     *
     * @param string|int $field
     */
    public function getRoomByField($field): Response
    {
        try {
            $room = $this->roomProvider->getRoomByField($field);
        } catch (EntityNotFoundException $e) {
            throw $this->createNotFoundException($e->getMessage(), $e);
        }

        return $this->render('room/room.html.twig', [
            'room' => $room,
        ]);
    }
}
