<?php

namespace Src\Auth\Register\Domain\Factories;

use Src\Auth\Register\Domain\Model\User;
use Src\Auth\Register\Domain\Model\ValueObjects\Name;
use Src\Auth\Register\Domain\Model\ValueObjects\Email;

class UserFactory
{
    public static function new(array $attributes = null): User
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
        ];

        $attributes = array_replace($defaults, $attributes);

        return (new User(
            id: null,
            name: new Name($attributes['name']),
            email: new Email($attributes['email']),
        ));
    }
}