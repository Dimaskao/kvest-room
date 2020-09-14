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

    public function __construct(int $id, string $name, string $image, string $description, string $peopleAndTimeInfo)
    {
        $this->id = $id;
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPeopleAndTimeInfo(): ?string
    {
        return $this->peopleAndTimeInfo;
    }

    public function setPeopleAndTimeInfo(string $peopleAndTimeInfo): self
    {
        $this->peopleAndTimeInfo = $peopleAndTimeInfo;

        return $this;
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

    public function publish(): void
    {
        $this->available = true;
    }
}
