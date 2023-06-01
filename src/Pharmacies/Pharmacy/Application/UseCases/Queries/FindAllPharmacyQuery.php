<?php

namespace Src\Pharmacies\Pharmacy\Application\UseCases\Queries;

use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;


class FindAllPharmacyQuery 
{
    private PharmacyRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app()->make(PharmacyRepositoryInterface::class);
    }

    public function __invoke(): array
    {
        return $this->repository->findAll();
    }
}