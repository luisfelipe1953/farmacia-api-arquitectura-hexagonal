<?php

declare(strict_types=1);

namespace App\Exceptions;

use DomainException;

class CustomInvalidArgumentException extends DomainException
{
    public static function withMessage($message): self
    {
        return new self($message);
    }
}