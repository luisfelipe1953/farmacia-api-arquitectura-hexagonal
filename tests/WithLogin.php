<?php

namespace Tests;

use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Auth\Register\Domain\Factories\UserFactory;
use Src\Auth\Register\Application\Mappers\UserMapper;

trait WithLogin
{
    use WithFaker;

    /**
     * Create a new user instance.
     */
    protected function validCredentials(array $attributes = null): array
    {
        $password = $this->faker->password(8);
        $user = UserFactory::new($attributes);
        $userEloquent = UserMapper::toEloquent($user);

        $userEloquent->password = $password;
        $userEloquent->save();

        return [
            'id'         => $userEloquent->id,
            'email'      => $user->email,
            'password'   => $password,
        ];
    }

    protected function newLoggedUser(): array
    {
        $credentials = $this->validCredentials();
        $response = $this->post('api/login', $credentials);
        return ['token' => $this->getToken($response), ...$credentials];
    }

    protected function getToken(TestResponse $response)
    {
        $arResponse = json_decode($response->getContent(), true);
        return $arResponse['accessToken'];
    }
}