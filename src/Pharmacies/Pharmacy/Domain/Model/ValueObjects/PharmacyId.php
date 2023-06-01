<?php

declare(strict_types=1);

namespace Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects;

use App\Domain\ValueObject;

final class PharmacyId extends ValueObject
{
    public function __construct(public readonly ?int $phamacyId)
    {
    }

    public function jsonSerialize(): ?int
    {
        return $this->phamacyId;
    }
}