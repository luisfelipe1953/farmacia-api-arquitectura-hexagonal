<?php

namespace Src\Auth\login\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Auth\login\Domain\AuthInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(protected readonly AuthInterface $auth)
    {
    }
    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $email = $request->get('email');
            $password = $request->get('password');
            $credentials = ['email' => strtolower($email), 'password' => $password];
            $validator = Validator::make($credentials, [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            
            $token = $this->auth->login($credentials);
            return $this->respondWithToken($token);
        } catch (ValidationException $validationException) {
            return response()->json($validationException->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (AuthenticationException) {
            return response()->json(['error' => 'el usuario no existe o las credenciales son las incorrectas'], Response::HTTP_UNAUTHORIZED );
        }
    }

     /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'accessToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 1,
        ]);
    }
}