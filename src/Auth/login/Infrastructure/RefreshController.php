<?php
namespace Src\Auth\login\Infrastructure;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Auth\login\Domain\AuthInterface;
use Illuminate\Auth\AuthenticationException;

class RefreshController extends Controller
{
    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

        /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            $token = $this->auth->refresh();
        } catch (AuthenticationException $e) {
            return response()->json(['status' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        return $this->respondWithToken($token);
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