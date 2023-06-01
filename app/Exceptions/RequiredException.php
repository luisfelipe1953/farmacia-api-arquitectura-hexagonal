<?php

namespace App\Exceptions;

final class RequiredException extends \DomainException
{
    public function __construct($fieldName)
    {
        $message = "El campo {$fieldName} es requerido.";
        parent::__construct($message);
    }
}