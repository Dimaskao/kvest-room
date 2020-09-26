<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Comment;

interface CommentServiceInterface
{
    public function saveComment(int $roomId, string $text): void;

    public function removeComment(Comment $comment): void;
}
