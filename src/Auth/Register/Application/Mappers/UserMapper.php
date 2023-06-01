<?php
namespace Src\Auth\Register\Application\Mappers;

use Illuminate\Http\Request;
use Src\Auth\Register\Domain\Model\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Src\Auth\Register\Domain\Model\ValueObjects\Name;
use Src\Auth\Register\Domain\Model\ValueObjects\Email;
use Src\Auth\Register\Infrastructure\EloquentModels\UserEloquentModel;



class UserMapper
{
    public static function fromRequest(Request $request, ?int $user_id = null): User
    {
        return new User(
            id: $user_id,
            name: new Name($request->string('name')),
            email: new Email($request->string('email')),
        );
    }

    public static function fromEloquent(UserEloquentModel $userEloquent): User
    {
        return new User(
            id: $userEloquent->id,
            name: new Name($userEloquent->name),
            email: new Email($userEloquent->email),
        );
    }

    public static function fromAuth(Authenticatable $userEloquent): User
    {
        return new User(
            id: $userEloquent->id,
            name: new Name($userEloquent->name),
            email: new Email($userEloquent->email),
         );
    }

    public static function toEloquent(User $user): UserEloquentModel
    {
        $userEloquent = new UserEloquentModel();
        if ($user->id) {
            $userEloquent = UserEloquentModel::query()->findOrFail($user->id);
        }
        $userEloquent->name = $user->name;
        $userEloquent->email = $user->email;
        return $userEloquent;
    }
}