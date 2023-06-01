<?php

namespace Src\Auth\Register\Application\Repositories\Eloquent;

use Src\Auth\Register\Domain\Model\User;
use Src\Auth\Register\Application\Mappers\UserMapper;
use Src\Auth\Register\Domain\Model\ValueObjects\Password;
use Src\Auth\Register\Domain\Repositories\UserRepositoryInterface;



class UserRepository implements UserRepositoryInterface
{
    public function register(User $user, Password $password): User
    {
        $userEloquent = UserMapper::toEloquent($user);
        $userEloquent->password = $password->value;
        $userEloquent->save();

        return UserMapper::fromEloquent($userEloquent);
    }
}