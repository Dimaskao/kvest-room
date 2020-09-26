<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\RoomList;
use App\Entity\Room;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

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
    private ParameterBagInterface $parameters;

    public function __construct(RoomRepository $roomRepository, EntityManagerInterface $em, ParameterBagInterface $parameters)
    {
        $this->roomRepository = $roomRepository;
        $this->em = $em;
        $this->parameters = $parameters;
    }

    public function getRooms($id = null)
    {
        if (null === $id) {
            $rooms = $this->roomRepository->findAll();

            return new RoomList($rooms);
        }

        return $this->roomRepository->find($id);
    }

    public function editRoom(string $roomId, string $name, $photo, string $description, $isAvailable, string $peopleAndTimeInfo): void
    {
        $room = $this->roomRepository->find($roomId);
        $room->addName($name);
        if (null !== $photo) {
            $fileName = $photo->getClientOriginalName();
            $path = $this->parameters->get('app.save_photo_path');
            $photo->move($path, $fileName);

            $room->addImage('uploads/'.$fileName);
        }
        $room->addDescription($description);
        if ($isAvailable) {
            $room->makeAvailable();
        } else {
            $room->makeNotAvailable();
        }
        $room->addPeopleAndTimeInfo($peopleAndTimeInfo);

        $this->em->persist($room);
        $this->em->flush();
    }

    public function addRoom(string $fileName, $photo, string $name, string $description, string $peopleAndTimeInfo, $isAvailable): void
    {
        $path = $this->parameters->get('app.save_photo_path');
        $photo->move($path, $fileName);

        $pathIntoDb = $this->parameters->get('app.photo_into_db');

        $image = $pathIntoDb.$fileName;

        $room = new Room(
            $name,
            $image,
            $description,
            $peopleAndTimeInfo,
        );
        if ($isAvailable) {
            $room->makeAvailable();
        }

        $this->em->persist($room);
        $this->em->flush();
    }
}
