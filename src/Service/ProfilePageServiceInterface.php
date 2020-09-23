<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ProfilePageServiceInterface
{
    public function savePhoto(Request $request);

    public function removeProfile(Request $request);
}
