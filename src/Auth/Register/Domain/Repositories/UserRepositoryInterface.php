<?php

namespace Src\Auth\Register\Domain\Repositories;

use Src\Auth\Register\Domain\Model\User;
use Src\Auth\Register\Domain\Model\ValueObjects\Password;

interface UserRepositoryInterface
{
    public function register(User $user, Password $password): User;
}
