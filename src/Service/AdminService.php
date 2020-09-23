<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\RoomList;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminService implements AdminServiceInterface
{
    private RoomRepository $roomRepository;
    private EntityManagerInterface $em;

    public function __construct(RoomRepository $roomRepository, EntityManagerInterface $em)
    {
        $this->roomRepository = $roomRepository;
        $this->em = $em;
    }

    public function getRooms(?int $id = null)
    {
        if (null === $id) {
            $rooms = $this->roomRepository->findAll();

            return new RoomList($rooms);
        }

        return $this->roomRepository->find($id);
    }

    public function editRoom(Request $request, int $id): void
    {
        $room = $this->roomRepository->find($id);
        $room->addName($request->get('name'));
        if (null !== $request->files->get('photo')) {
            $fileName = $request->files->get('photo')->getClientOriginalName();
            $path = '../public/uploads/';
            $request->files->get('photo')->move($path, $fileName);

            $room->addImage('uploads/'.$fileName);
        }
        $room->addDescription($request->get('description'));
        if ($request->get('available')) {
            $room->makeAvailable();
        } else {
            $room->makeNotAvailable();
        }
        $room->addPeopleAndTimeInfo($request->get('peopleAndTimeInfo'));

        $this->em->persist($room);
        $this->em->flush();
    }

    public function setRoom()
    {
        // TODO: Implement setRoom() method.
    }

    public function removeRoom()
    {
        // TODO: Implement removeRoom() method.
    }
}
