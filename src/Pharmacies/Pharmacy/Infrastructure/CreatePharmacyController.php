<?php

namespace Src\Pharmacies\Pharmacy\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Pharmacies\Pharmacy\Application\Mappers\PharmacyMapper;
use Src\Pharmacies\Pharmacy\Application\UseCases\Commands\StorePharmacyCommand;

class CreatePharmacyController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $pharmcyData = PharmacyMapper::fromRequest($request);
            (new StorePharmacyCommand($pharmcyData))->__invoke();
            return $this->response->success('creado');
        } catch (\DomainException $domainException) {
            return response()->json($domainException->getMessage(), 422);
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }
}
