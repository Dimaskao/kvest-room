<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface AdminServiceInterface
{
    public function getRooms(?int $id = null);

    public function editRoom(Request $request, int $id);

    public function setRoom();

    public function removeRoom();
}
