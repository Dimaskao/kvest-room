<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\RoomList;
use App\Entity\Room;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function getRooms(?int $id = null)
    {
        if (null === $id) {
            $rooms = $this->roomRepository->findAll();

            return new RoomList($rooms);
        }

        return $this->roomRepository->find($id);
    }

    public function editRoom(int $roomId, string $name, ?UploadedFile $photo, string $description, bool $isAvailable, string $peopleCount, int $timeCount): void
    {
        $room = $this->roomRepository->find($roomId);
        $room->addName($name);
        if (null !== $photo) {
            $fileName = $photo->getClientOriginalName();
            $path = $this->parameters->get('app.save_photo_path');
            $pathIntoDb = $this->parameters->get('app.photo_into_db');
            $photo->move($path, $fileName);

            $room->addImage($pathIntoDb.$fileName);
        }
        $room->addDescription($description);
        if ($isAvailable) {
            $room->makeAvailable();
        } else {
            $room->makeNotAvailable();
        }
        $room->addTimeCount($timeCount);
        $room->addPeopleCount($peopleCount);

        $this->em->persist($room);
        $this->em->flush();
    }

    public function addRoom(string $fileName, UploadedFile $photo, string $name, string $description, bool $isAvailable, string $peopleCount, int $timeCount): void
    {
        $path = $this->parameters->get('app.save_photo_path');
        $photo->move($path, $fileName);

        $pathIntoDb = $this->parameters->get('app.photo_into_db');

        $image = $pathIntoDb.$fileName;

        $room = new Room(
            $name,
            $image,
            $description,
            $peopleCount,
            $timeCount,
        );
        if ($isAvailable) {
            $room->makeAvailable();
        }

        $this->em->persist($room);
        $this->em->flush();
    }
}
