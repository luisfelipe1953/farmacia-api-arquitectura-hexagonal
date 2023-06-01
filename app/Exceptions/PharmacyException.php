<?php

namespace App\Exceptions;

use Exception;

class PharmacyException extends Exception
{
    public function __construct($message = 'Error in Pharmacy', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
