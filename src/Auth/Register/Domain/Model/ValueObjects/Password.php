<?php

declare(strict_types=1);

namespace Src\Auth\Register\Domain\Model\ValueObjects;

use App\Domain\ValueObject;
use Src\Auth\Register\Domain\Exceptions\PasswordTooShortException;
use Src\Auth\Register\Domain\Exceptions\PasswordsDoNotMatchException;


final class Password extends ValueObject
{
    public ?string $value;

    public function __construct(?string $password, ?string $confirmation)
    {
        if ($password && strlen($password) < 8) {
            throw new PasswordTooShortException();
        }

        if ($password !== $confirmation) {
            throw new PasswordsDoNotMatchException();
        }

        $this->value = $password;
    }

    public static function fromString(string $password, string $confirmation): self
    {
        return new self($password, $confirmation);
    }

    public function isNotEmpty(): bool
    {
        return $this->value !== null;
    }

    public function jsonSerialize(): string
    {
        return '';
    }
}