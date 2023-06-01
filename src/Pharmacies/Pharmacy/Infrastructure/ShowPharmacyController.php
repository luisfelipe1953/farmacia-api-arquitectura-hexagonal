<?php

namespace Src\Pharmacies\Pharmacy\Infrastructure;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Pharmacies\Pharmacy\Application\UseCases\Queries\FindPharmacyByIdQuery;

class ShowPharmacyController extends Controller
{   
    public function __invoke(int $id): JsonResponse
    {
        try {
            return response()->json(['pharmacy' => (new FindPharmacyByIdQuery($id))->__invoke()]);
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }
}