<?php
namespace Src\Auth\login\Infrastructure;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Auth\login\Domain\AuthInterface;


class MeController extends Controller
{
    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

      /**
     * Get the authenticated UserEloquentModel.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return response()->json($this->auth->me()->toArray());
    }

}