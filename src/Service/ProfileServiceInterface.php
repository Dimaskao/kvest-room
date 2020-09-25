<?php

declare(strict_types=1);

namespace App\Service;

interface ProfileServiceInterface
{
    public function savePhoto(string $fileName, $photo);

    public function removeProfile();
}
