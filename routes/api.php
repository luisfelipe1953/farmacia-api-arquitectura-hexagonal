<?php

use Illuminate\Support\Facades\Route;


use Src\Pharmacies\Pharmacy\Infrastructure\AllPharmacyController;
use Src\Pharmacies\Pharmacy\Infrastructure\ShowPharmacyController;
use Src\Pharmacies\Pharmacy\Infrastructure\CreatePharmacyController;
use Src\Pharmacies\Pharmacy\Infrastructure\DeletePharmacyController;
use Src\Pharmacies\Pharmacy\Infrastructure\UpdatePharmacyController;
use Src\Pharmacies\Pharmacy\Infrastructure\GetNearestPharmacyController;

Route::get('/pharmacies', AllPharmacyController::class)->name('pharmacy.index');
Route::post('/pharmacies', CreatePharmacyController::class)->name('pharmacy.store');
Route::get('/pharmacies/{id}', ShowPharmacyController::class)->name('pharmacy.show');
Route::put('/pharmacies/{id}', UpdatePharmacyController::class)->name('pharmacy.update');
Route::delete('/pharmacies/{id}', DeletePharmacyController::class)->name('pharmacy.destroy');
Route::post('/pharmacies/nearby', GetNearestPharmacyController::class)->name('pharmacy.nearby');



use Src\Auth\login\Infrastructure\LoginController;
use Src\Auth\login\Infrastructure\logoutController;
use Src\Auth\login\Infrastructure\MeController;
use Src\Auth\login\Infrastructure\RefreshController;
use Src\Auth\Register\Infrastructure\RegisterController;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('logout', logoutController::class);
Route::post('refresh', RefreshController::class);
Route::get('me', MeController::class);
