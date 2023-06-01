<?php

namespace Src\Agenda\User\Application\UseCases\Commands;

use UserRepositoryInterface;
use App\Domain\CommandInterface;


class DestroyUserCommand implements CommandInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(
        private readonly int $id
    )
    {
        $this->repository = app()->make(UserRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->delete($this->id);
    }
}