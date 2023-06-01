<?php

namespace Src\Pharmacies\Pharmacy\Application\UseCases\Commands;

use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;
use Src\Pharmacies\Pharmacy\Infrastructure\EloquentModels\PharmacyEloquentModel;

class StorePharmacyCommand
{
    private PharmacyRepositoryInterface $repository;

    public function __construct(
        private readonly Pharmacy $pharmacy,
    ) {
        $this->repository = app()->make(PharmacyRepositoryInterface::class);
    }

    public function __invoke(): Pharmacy
    {
        return $this->repository->store($this->pharmacy);
    }
}
