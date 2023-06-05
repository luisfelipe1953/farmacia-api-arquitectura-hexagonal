<?php

namespace Src\Auth\Register\Application\Exceptions;

final class EmailAlreadyUsedException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('El email ya está en uso');
    }
}