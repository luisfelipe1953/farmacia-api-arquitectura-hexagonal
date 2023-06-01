<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Auth\Register\Domain\Repositories\UserRepositoryInterface;
use Src\Auth\Register\Application\Repositories\Eloquent\UserRepository;
use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;
use Src\Pharmacies\Pharmacy\Application\Repositories\Eloquent\EloquentPharmacyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PharmacyRepositoryInterface::class,
            EloquentPharmacyRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
