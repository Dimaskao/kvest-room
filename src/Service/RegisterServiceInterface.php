<?php

declare(strict_types=1);

namespace App\Service;

interface RegisterServiceInterface
{
    public function register(string $name, string $email, string $password, string $password_confirm);
}
