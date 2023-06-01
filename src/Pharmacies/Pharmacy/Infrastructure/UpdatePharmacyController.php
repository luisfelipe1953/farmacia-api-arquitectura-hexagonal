<?php

namespace Src\Pharmacies\Pharmacy\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Pharmacies\Pharmacy\Application\Mappers\PharmacyMapper;
use Src\Pharmacies\Pharmacy\Application\UseCases\Commands\UpdatePharmacyCommand;

class UpdatePharmacyController extends Controller
{
    public function __invoke(int $id, Request $request): JsonResponse
    {
        try {
            $pharmacy = PharmacyMapper::fromRequest($request, $id);
            (new UpdatePharmacyCommand($pharmacy))->__invoke();
            return $this->response->success('actualizado');
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }
}
