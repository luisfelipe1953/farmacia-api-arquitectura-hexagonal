<?php

namespace Src\Pharmacies\Pharmacy\Domain\Repositories;

use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Latitude;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Longitude;

interface PharmacyRepositoryInterface
{
    public function findAll(): array;

    public function findById(string $phamacyId): Pharmacy;

    public function store(Pharmacy $pharmacy): Pharmacy;

    public function update(Pharmacy $pharmacy): void;

    public function delete(int $phamacyId): void;

    public function findNeartPharmacy(Latitude $latitude, Longitude $longitude): array;
}
