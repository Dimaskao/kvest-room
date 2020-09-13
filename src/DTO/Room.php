<?php

namespace App\DTO;

/**
 * Storage information about room.
 *
 * @author Dmytro Lytvynchuk <dmytrolutv@gmail.com>
 */
final class Room
{
    private int $id;
    private string $name;
    private string $image;
    private ?string $description = null;
    private ?string $peopleAndTimeInfo = null;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPeopleAndTimeInfo(): array
    {
        return \explode('|', $this->peopleAndTimeInfo);
    }
}
