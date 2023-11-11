<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'jwt.auth'], function () {
});

Route::post('/pharmacies', Src\Pharmacies\Pharmacy\Infrastructure\CreatePharmacyController::class);
Route::put('/pharmacies/{id}', Src\Pharmacies\Pharmacy\Infrastructure\UpdatePharmacyController::class);
Route::delete('/pharmacies/{id}', Src\Pharmacies\Pharmacy\Infrastructure\DeletePharmacyController::class);

Route::post('/pharmacy-nearby', Src\Pharmacies\Pharmacy\Infrastructure\GetNearestPharmacyController::class);
Route::get('/pharmacies/{id}', Src\Pharmacies\Pharmacy\Infrastructure\ShowPharmacyController::class);
Route::get('/pharmacies', Src\Pharmacies\Pharmacy\Infrastructure\AllPharmacyController::class);


Route::post('register', Src\Auth\Register\Infrastructure\RegisterController::class);
Route::post('login', Src\Auth\login\Infrastructure\LoginController::class);
Route::post('logout', Src\Auth\login\Infrastructure\LogoutController::class);
Route::post('refresh', Src\Auth\login\Infrastructure\RefreshController::class);
Route::get('me', Src\Auth\login\Infrastructure\MeController::class);
