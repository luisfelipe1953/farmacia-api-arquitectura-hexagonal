<?php

namespace Src\Auth\Register\Infrastructure\EloquentModels;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Src\Auth\Register\Infrastructure\EloquentModels\Casts\PasswordCast;

class UserEloquentModel extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable, WithFaker;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public array $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'confirmed|min:8|nullable',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => PasswordCast::class
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
