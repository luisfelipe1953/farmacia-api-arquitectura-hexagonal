<?php

namespace Src\Pharmacies\Pharmacy\Application\UseCases\Queries;

use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Latitude;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Longitude;
use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;

class FindNeartPharmacyQuery
{
    private PharmacyRepositoryInterface $repository;

    public function __construct(
        private readonly Latitude $latitude,
        private readonly Longitude $longitude,
    )
    {
        $this->repository = app()->make(PharmacyRepositoryInterface::class);
    }

    public function __invoke(): array
    {
        return $this->repository->findNeartPharmacy($this->latitude, $this->longitude);
    }
}