<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface CommentPageServiceInterface
{
    public function saveComment(Request $request);
}
