<?php

namespace Src\Pharmacies\Pharmacy\Domain\Factories;

use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Name;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Address;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Latitude;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Longitude;

class PharmacyFactory
{
    public static function new(array $attributes = null): Pharmacy
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
        ];

        $attributes = array_replace($defaults, $attributes);

        return (new Pharmacy(
            id: null,
            name: new Name($attributes['name']),
            address: new Address($attributes['address']),
            longitude: new Longitude($attributes['latitude']),
            latitude: new Latitude($attributes['longitude']),
        ));
    }
}