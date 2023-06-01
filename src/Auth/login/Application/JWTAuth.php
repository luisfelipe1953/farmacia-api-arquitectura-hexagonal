<?php

namespace Src\Auth\login\Application;

use Illuminate\Support\Facades\Log;
use Src\Auth\login\Domain\AuthInterface;
use Src\Auth\Register\Domain\Model\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException;
use Tymon\JWTAuth\Facades\JWTAuth as TymonJWTAuth;
use Src\Auth\Register\Application\Mappers\UserMapper;
use Src\Auth\Register\Infrastructure\EloquentModels\UserEloquentModel;

class JWTAuth implements AuthInterface
{
    public function login(array $credentials): string
    {
        $user = UserEloquentModel::query()->where('email', $credentials['email'])->first();
        if (!$user) {
            throw new AuthenticationException();
        } elseif (!$token = auth()->attempt($credentials)) {
            throw new AuthenticationException();
        }
        return $token;
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function me(): User
    {
        return UserMapper::fromAuth(auth()->user());
    }

    public function refresh(): string
    {
        try {
            return TymonJWTAuth::parseToken()->refresh();
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            throw new AuthenticationException($e->getMessage());
        }
    }
}
