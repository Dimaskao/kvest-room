<?php

declare(strict_types=1);

namespace App\Entity;

use App\DTO\RoomDTO;
use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $image;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private string $peopleAndTimeInfo;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $available = false;

    public function __construct(string $name, string $image, string $description, string $peopleAndTimeInfo)
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->peopleAndTimeInfo = $peopleAndTimeInfo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPeopleAndTimeInfo(): ?string
    {
        return $this->peopleAndTimeInfo;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getRoom()
    {
        $roomDTO = new RoomDTO(
            $this->id,
            $this->name,
            $this->image
        );

        $roomDTO->setDescription($this->description);
        $roomDTO->setPeopleAndTimeInfo($this->peopleAndTimeInfo);

        return $roomDTO;
    }

    public function makeAvailable(): void
    {
        $this->available = true;
    }
}
