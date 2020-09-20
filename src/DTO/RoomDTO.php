<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Storage information about room.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class RoomDTO
{
    private int $id;
    private string $name;
    private string $image;
    private ?string $description = null;
    private ?string $peopleAndTimeInfo = null;
    private $comments;

    public function __construct(int $id, string $name, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): ?string
    {
        return $this->description ?? null;
    }

    public function getPeopleAndTimeInfo(): ?array
    {
        return \explode('|', $this->peopleAndTimeInfo) ?? null;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setPeopleAndTimeInfo(?string $peopleAndTimeInfo): void
    {
        $this->peopleAndTimeInfo = $peopleAndTimeInfo;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments): void
    {
        $this->comments = $comments;
    }
}
