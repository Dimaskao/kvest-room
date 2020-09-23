<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface AdminServiceInterface
{
    public function getRooms($id = null);

    public function editRoom(Request $request);

    public function addRoom(Request $request);
}
