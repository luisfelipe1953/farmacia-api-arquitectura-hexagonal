<?php

namespace Src\Pharmacies\Pharmacy\Application\Repositories\Eloquent;


use Src\Pharmacies\Pharmacy\Domain\Model\Pharmacy;
use Src\Pharmacies\Pharmacy\Application\Mappers\PharmacyMapper;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Latitude;
use Src\Pharmacies\Pharmacy\Domain\Model\ValueObjects\Longitude;
use Src\Pharmacies\Pharmacy\Domain\Repositories\PharmacyRepositoryInterface;
use Src\Pharmacies\Pharmacy\Infrastructure\EloquentModels\PharmacyEloquentModel;

class EloquentPharmacyRepository implements PharmacyRepositoryInterface
{
    public function findAll(): array
    {
        $pharmacies = [];
        foreach (PharmacyEloquentModel::all() as $pharmacyEloquent) {
            $pharmacies[] = PharmacyMapper::fromEloquent($pharmacyEloquent);
        }
        return $pharmacies;
    }

    public function findById(string $noteId): Pharmacy
    {
        $pharmacyEloquent = PharmacyEloquentModel::query()->findOrFail($noteId);
        return PharmacyMapper::fromEloquent($pharmacyEloquent);
    }

    public function store(Pharmacy $pharmacy): Pharmacy
    {
        $pharmacyEloquent = PharmacyMapper::toEloquent($pharmacy);
        $pharmacyEloquent->save();

        return PharmacyMapper::fromEloquent($pharmacyEloquent);
    }

    public function update(Pharmacy $pharmacy): void
    {
        $pharmacyEloquent = PharmacyMapper::toEloquent($pharmacy);
        $pharmacyEloquent->save();
    }

    public function delete(int $pharmacyId): void
    {
        $pharmacyEloquent = PharmacyEloquentModel::query()->findOrFail($pharmacyId);
        $pharmacyEloquent->delete();
    }

    public function findNeartPharmacy(Latitude $latitude, Longitude $longitude): array
    {

        // mysql
        $neartPharmacies = PharmacyEloquentModel::select('id', 'name', 'address', 'latitude', 'longitude')
            ->orderByRaw("ST_Distance_Sphere(POINT(?, ?), POINT(longitude, latitude)) ASC", [$longitude->__toString(), $latitude->__toString()])
            ->limit(1)
            ->get()
            ->map(function ($pharmacyEloquent) {
                return PharmacyMapper::fromEloquent($pharmacyEloquent);
            })
            ->all();

        // postgres
        // $neartPharmacies = PharmacyEloquentModel::select('id', 'name', 'address', 'latitude', 'longitude')
        //     ->orderByRaw("ST_DistanceSphere(ST_MakePoint(?, ?), ST_MakePoint(longitude, latitude)) ASC", [$longitude, $latitude])
        //     ->limit(1)
        //     ->get()
        //     ->map(function ($pharmacyEloquent) {
        //         return PharmacyMapper::fromEloquent($pharmacyEloquent);
        //     })
        //     ->all();    

            //SELECT postgis_version();
            //CREATE EXTENSION IF NOT EXISTS postgis;

        return $neartPharmacies;
    }
}
