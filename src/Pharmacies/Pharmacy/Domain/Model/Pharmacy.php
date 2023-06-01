<?php

declare(strict_types=1);

namespace Src\Pharmacies\Pharmacy\Domain\Model;

use App\Domain\AggregateRoot;

use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Name;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Address;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Latitude;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Longitude;

class Pharmacy extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly Name $name,
        public readonly Address $address,
        public readonly Latitude $latitude,
        public readonly Longitude $longitude,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
