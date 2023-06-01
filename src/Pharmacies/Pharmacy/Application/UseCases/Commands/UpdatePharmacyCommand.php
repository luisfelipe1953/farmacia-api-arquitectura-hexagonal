<?php

namespace Src\Pharmacies\Pharmacy\Application\UseCases\Commands;

use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;

class UpdatePharmacyCommand
{
    private PharmacyRepositoryInterface $repository;

    public function __construct(
        private readonly Pharmacy $pharmacy,
    ) {
        $this->repository = app()->make(PharmacyRepositoryInterface::class);
    }

    public function __invoke(): void
    {
        $this->repository->update($this->pharmacy);
    }
}
