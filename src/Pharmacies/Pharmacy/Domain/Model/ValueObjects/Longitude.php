<?php

declare(strict_types=1);

namespace Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects;

use App\Domain\ValueObject;
use App\Exceptions\RequiredException;
use App\Exceptions\CustomInvalidArgumentException;

final class Longitude extends ValueObject
{   
    private ?string $longitude;

    public function __construct(?string $longitude)
    {
        if(!$longitude){
            throw new RequiredException('longitude');
        }

        if (!preg_match('/^-?\d+(\.\d+)?$/', $longitude)) {
            throw new CustomInvalidArgumentException('la longitude debe ser una cordenada');
        }

        $this->longitude = $longitude;
    }   

    public function __toString(): string
    {
        return $this->longitude;
    }


    public function jsonSerialize(): ?string
    {
        return $this->longitude;
    }
}