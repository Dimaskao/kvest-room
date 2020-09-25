<?php

declare(strict_types=1);

namespace App\Service;

interface AdminServiceInterface
{
    public function getRooms($id = null);

    public function editRoom(string $roomId, string $name, $photo, string $description, $isAvailable, string $peopleAndTimeInfo);

    public function addRoom(string $fileName, $photo, string $name, string $description, string $peopleAndTimeInfo, $isAvailable);
}
