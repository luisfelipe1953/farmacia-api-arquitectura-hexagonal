<?php

namespace App\Exceptions;

final class IncorrectEmailFormatException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('el email no es valido');
    }
}