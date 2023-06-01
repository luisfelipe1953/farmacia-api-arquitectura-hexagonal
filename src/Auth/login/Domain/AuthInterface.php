<?php

namespace Src\Auth\login\Domain;

use Src\Auth\Register\Domain\Model\User;
use Illuminate\Auth\AuthenticationException;

interface AuthInterface
{
    /**
     * @throws AuthenticationException
     */
    public function login(array $credentials): string;
    /**
     * @throws AuthenticationException
     */
    public function refresh(): string;

    public function me(): User;

    public function logout(): void;
    
}