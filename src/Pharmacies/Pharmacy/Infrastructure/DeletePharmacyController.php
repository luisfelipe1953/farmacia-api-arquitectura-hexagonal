<?php

namespace Src\Pharmacies\Pharmacy\Infrastructure;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Pharmacies\Pharmacy\Application\UseCases\Commands\DestroyPharmacyCommand;

class DeletePharmacyController extends Controller
{
    public function __invoke(int $id): JsonResponse
    {
        try {
            (new DestroyPharmacyCommand($id))->__invoke();
            return $this->response->success('eliminado');
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }
}
