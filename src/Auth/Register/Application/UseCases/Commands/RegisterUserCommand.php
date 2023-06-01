<?php

namespace Src\Auth\Register\Application\UseCases\Commands;

use Src\Auth\Register\Domain\Model\User;
use Src\Auth\Register\Domain\Model\ValueObjects\Password;
use Src\Auth\Register\Domain\Repositories\UserRepositoryInterface;
use Src\Agenda\User\Application\Exceptions\EmailAlreadyUsedException;
use Src\Auth\Register\Infrastructure\EloquentModels\UserEloquentModel;

class RegisterUserCommand
{
    private UserRepositoryInterface $repository;

    public function __construct(
        private readonly User $user,
        private readonly Password $password
    )
    {
        $this->repository = app()->make(UserRepositoryInterface::class);
    }

    public function __invoke(): User
    {
        if (UserEloquentModel::query()->where('email', $this->user->email)->exists()) {
            throw new EmailAlreadyUsedException();
        }
        return $this->repository->register($this->user, $this->password);
    }
}