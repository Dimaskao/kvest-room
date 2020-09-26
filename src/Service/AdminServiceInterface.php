<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AdminServiceInterface
{
    public function getRooms(?int $id = null);

    public function editRoom(int $roomId, string $name, ?UploadedFile $photo, string $description, bool $isAvailable, string $peopleAndTimeInfo);

    public function addRoom(string $fileName, UploadedFile $photo, string $name, string $description, string $peopleAndTimeInfo, bool $isAvailable);
}
