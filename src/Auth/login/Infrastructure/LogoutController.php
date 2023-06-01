<?php
namespace Src\Auth\login\Infrastructure;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Auth\login\Domain\AuthInterface;


class logoutController extends Controller
{
    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $this->auth->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}