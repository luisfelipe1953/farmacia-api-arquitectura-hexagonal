<?php


declare(strict_types=1);

namespace Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects;

use App\Domain\ValueObject;
use App\Exceptions\RequiredException;
use App\Exceptions\CustomInvalidArgumentException;

final class Latitude extends ValueObject
{   
    private ?string  $latitude;

    public function __construct(?string  $latitude)
    {
        if(!$latitude){
            throw new RequiredException('latitud');
        }

        if (!preg_match('/^-?\d+(\.\d+)?$/', $latitude)) {
            throw new CustomInvalidArgumentException('la latitud debe ser una cordenada');
        }

        $this->latitude = $latitude;
    }

    public function __toString(): string
    {
        return $this->latitude;
    }

    public function jsonSerialize(): ?string
    {
        return $this->latitude;
    }
}