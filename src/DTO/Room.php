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
    private string $description;
    private string $peopleAndTimeInfo;

    public function __construct(int $id, string $name, string $image, string $description, string $peopleAndTimeInfo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->peopleAndTimeInfo = $peopleAndTimeInfo;
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
