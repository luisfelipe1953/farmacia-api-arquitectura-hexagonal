<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\WithLogin;
use Src\Auth\Register\Domain\Model\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithLogin;

    protected User $user;
    protected string $login_uri;
    protected string $logout_uri;
    protected string $refresh_uri;
    protected string $me_uri;
    protected string $token;

    /**
     * Create a new faker instance.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();
        $this->login_uri = 'api/login';
        $this->logout_uri = 'api/logout';
        $this->refresh_uri = 'api/refresh';
        $this->me_uri = 'api/me';
        $this->token = $this->newLoggedUser()['token'];
    }

    /** @test */
    public function user_can_login()
    {
        $this->withoutExceptionHandling();

        $credentials = $this->validCredentials();

        $this->post($this->login_uri, $credentials)
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertSee(['accessToken']);

        $this->assertAuthenticated();
    }

    /** @test */
    public function user_can_not_login_without_credentials()
    {
        $this->post($this->login_uri, [])
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertSee([
                'email'    => 'The email field is required.',
                'password' => 'The password field is required.',
            ]);
    }

    /** @test */
    public function user_can_not_login_without_email()
    {
        $credentials = $this->validCredentials();
        unset($credentials['email']);

        $this->post($this->login_uri, $credentials)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertSee([
                'email' => 'The email field is required.',
            ]);
    }

    /** @test */
    public function user_can_not_login_without_password()
    {
        $credentials = $this->validCredentials();
        unset($credentials['password']);

        $this->post($this->login_uri, $credentials)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertSee([
                'password' => 'The password field is required.',
            ]);
    }

    /** @test */
    public function user_can_not_login_with_invalid_credentials()
    {
        $credentials = ['email' => 'test@invalid.credentials', 'password' => 'invalid'];

        $this->post($this->login_uri, $credentials)
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertSee(['error' => 'Unauthorized']);
    }

    /** @test */
    public function user_can_get_his_own_info()
    {
        $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->get($this->me_uri)
            ->assertStatus(Response::HTTP_OK)
            ->assertSee(['id', 'name', 'email']);
    }

    /** @test */
    public function logged_user_can_logout()
    {
        $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->post($this->logout_uri)
            ->assertStatus(Response::HTTP_OK)
            ->assertSee(['message' => 'Successfully logged out']);

        $this->assertGuest();
    }

    /** @test */
    public function logged_user_can_refresh()
    {
        $this->withoutExceptionHandling();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->post($this->refresh_uri)
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertSee(['accessToken']);

        $newToken = $this->getToken($response);

        // The previous token should be invalid.
        $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->post($this->refresh_uri)
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertSee(['status']);

        // The new token should be valid.
        $this->withHeaders(['Authorization' => 'Bearer ' . $newToken])->get($this->me_uri)
            ->assertStatus(Response::HTTP_OK);
    }
}
