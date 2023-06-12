<?php
namespace Src\Modules\Auth\Application\Mapper;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Auth\Register\Application\Mappers\UserMapper;
use Src\Auth\Register\Domain\Model\ValueObjects\Password;
use Src\Auth\Register\Application\UseCases\Commands\RegisterUserCommand;

class RegisterController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $userData = UserMapper::fromRequest($request);
            $password = new Password($request->input('password'), $request->input('password_confirmation'));
            (new RegisterUserCommand($userData, $password))->__invoke();
            return response()->json(200);
        } catch (\DomainException $domainException) {
            return response()->json(['error' => $domainException->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
