<?php

declare(strict_types=1);

namespace App\Service;

interface CommentServiceInterface
{
    public function saveComment($roomId, string $text): void;

    public function removeComment($comment): void;
}
