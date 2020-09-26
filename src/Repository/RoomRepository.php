<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Room;
use App\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    public function getRoomList(): array
    {
        $query = $this->createQueryBuilder('r')
            ->select('r.id', 'r.name', 'r.image')
            ->where('r.available = true')
            ->orderBy('r.id', 'DESC')
            ->getQuery();

        return $query->getResult();
    }

    public function getRoomFromDB(int $id): Room
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.id = :id')
            ->andWhere('r.available = true')
            ->setParameter('id', $id)
            ->getQuery();

        $room = $query->getOneOrNullResult();

        if (null === $room) {
            throw new EntityNotFoundException('Room', $id);
        }

        return $room;
    }
}
