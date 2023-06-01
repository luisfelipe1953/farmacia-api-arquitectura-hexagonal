<?php


declare(strict_types=1);

namespace Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects;

use App\Domain\ValueObject;
use App\Exceptions\RequiredException;

final class Address extends ValueObject
{
    private ?string $address;

    public function __construct(?string $address)
    {
        if (!$address) {
            throw new RequiredException('la direccion');
        }

        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }

    public function jsonSerialize(): string
    {
        return $this->address;
    }
}
