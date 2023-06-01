<?php

namespace Src\Auth\Register\Domain\Exceptions;

final class PasswordsDoNotMatchException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Las contraseñas no coinciden');
    }
}