<?php

namespace Src\Pharmacies\Pharmacy\Application\UseCases\Queries;

use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;

class FindPharmacyByIdQuery
{
    private PharmacyRepositoryInterface $repository;

    public function __construct(
        private readonly int $id
    )
    {
        $this->repository = app()->make(PharmacyRepositoryInterface::class);
    }

    public function __invoke(): Pharmacy
    {
        return $this->repository->findById($this->id);
    }
}