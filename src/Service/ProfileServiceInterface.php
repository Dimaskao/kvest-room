<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ProfileServiceInterface
{
    public function savePhoto(string $fileName, UploadedFile $photo);

    public function removeProfile();
}
