<?php

namespace Src\Pharmacies\Pharmacy\Application\Mappers;

use Illuminate\Http\Request;
use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Name;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Address;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Latitude;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Longitude;
use Src\Pharmacies\Pharmacy\Infrastructure\EloquentModels\PharmacyEloquentModel;

class PharmacyMapper
{
    public static function fromRequest(Request $request, ?int $id = null): Pharmacy
    {
        return new Pharmacy(
            id: $id,
            name: new Name($request->input('name')),
            address: new Address($request->input('address')),
            latitude: new Latitude($request->input('latitude')),
            longitude: new Longitude($request->input('longitude')),
        );
    }

    public static function fromEloquent(PharmacyEloquentModel $pharmacyEloquent): Pharmacy
    {
        return new Pharmacy(
            id: $pharmacyEloquent->id,
            name: new Name($pharmacyEloquent->name),
            address: new Address($pharmacyEloquent->address),
            latitude: new Latitude($pharmacyEloquent->latitude),
            longitude: new Longitude($pharmacyEloquent->longitude),
        );
    }

    public static function toEloquent(Pharmacy $pharmacy): PharmacyEloquentModel
    {
        $pharmacyEloquent = new PharmacyEloquentModel();

        if ($pharmacy->id) {
            $pharmacyEloquent = PharmacyEloquentModel::query()->findOrFail($pharmacy->id);
        }

        $pharmacyEloquent->name = $pharmacy->name;

        $pharmacyEloquent->address = $pharmacy->address;

        $pharmacyEloquent->latitude = $pharmacy->latitude;

        $pharmacyEloquent->longitude = $pharmacy->longitude;

        return $pharmacyEloquent;
    }
}