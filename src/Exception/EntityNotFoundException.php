<?php

declare(strict_types=1);

namespace App\Exception;

class EntityNotFoundException extends \RuntimeException
{
    public function __construct($field)
    {
        $message = \sprintf('Room "%s" not found.',$field);

        parent::__construct($message);
    }
}
