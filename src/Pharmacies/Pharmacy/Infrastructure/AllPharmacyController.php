<?php

namespace Src\Pharmacies\Pharmacy\Infrastructure;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Src\Pharmacies\Pharmacy\Application\UseCases\Queries\FindAllPharmacyQuery;

class AllPharmacyController extends Controller
{
    public function __invoke(): JsonResponse
    {
        try {
            return response()->json(['pharmacies' => ((new FindAllPharmacyQuery())->__invoke())]);
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }
}
