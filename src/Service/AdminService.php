<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\RoomList;
use App\Entity\Room;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * This class get data for admin page.
 * Also saves and edits rooms.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class AdminService implements AdminServiceInterface
{
    private RoomRepository $roomRepository;
    private EntityManagerInterface $em;

    public function __construct(RoomRepository $roomRepository, EntityManagerInterface $em)
    {
        $this->roomRepository = $roomRepository;
        $this->em = $em;
    }

    public function getRooms($id = null)
    {
        if (null === $id) {
            $rooms = $this->roomRepository->findAll();

            return new RoomList($rooms);
        }

        return $this->roomRepository->find($id);
    }

    public function editRoom(Request $request): void
    {
        $roomId = $request->get('room');
        $room = $this->roomRepository->find($roomId);
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

    public function addRoom(Request $request): void
    {
        $fileName = $request->files->get('photo')->getClientOriginalName();
        $path = '../public/uploads/';
        $request->files->get('photo')->move($path, $fileName);
        $image = 'uploads/'.$fileName;

        $room = new Room(
            $request->get('name'),
            $image,
            $request->get('description'),
            $request->get('peopleAndTimeInfo'),
        );
        if ($request->get('available')) {
            $room->makeAvailable();
        }

        $this->em->persist($room);
        $this->em->flush();
    }
}
