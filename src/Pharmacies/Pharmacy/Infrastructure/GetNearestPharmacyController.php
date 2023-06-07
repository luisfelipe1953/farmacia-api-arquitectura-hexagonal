<?php

namespace Src\Pharmacies\Pharmacy\Infrastructure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Src\Pharmacies\Pharmacy\Application\UseCases\Queries\FindNeartPharmacyQuery;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Latitude;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Longitude;

class GetNearestPharmacyController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $latitude = new Latitude($request->input('latitude'));
            $longitude = new Longitude($request->input('longitude'));

            return (new FindNeartPharmacyQuery($latitude, $longitude))->__invoke();
        } catch (\DomainException $domainException) {
            return response()->json($domainException->getMessage(), 422);
        } catch (\Exception $e) {
            return $this->response->catch($e->getMessage());
        }
    }
}
