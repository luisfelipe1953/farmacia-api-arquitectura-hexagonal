<?php

namespace Src\Pharmacies\Pharmacy\Application\UseCases\Commands;

use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;

class DestroyPharmacyCommand
{
    private PharmacyRepositoryInterface $repository;

    public function __construct(
        private readonly int $id
    )
    {
        $this->repository = app()->make(PharmacyRepositoryInterface::class);
    }

    public function __invoke(): void
    {
        $this->repository->delete($this->id);
    }
}