<?php

declare(strict_types=1);

namespace Src\Auth\Register\Domain\Model\ValueObjects;

use App\Domain\ValueObject;
use App\Exceptions\RequiredException;


final class Name extends ValueObject
{
    private string $name;

    public function __construct(?string $name)
    {

        if (!$name) {
            throw new RequiredException('nombre');
        }

        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): string
    {
        return $this->name;
    }
}