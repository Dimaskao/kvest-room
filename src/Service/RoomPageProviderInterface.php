<?php

declare(strict_types=1);

namespace App\Service;

interface RoomPageProviderInterface
{
    public function getRoomBySlug($slug);
}
