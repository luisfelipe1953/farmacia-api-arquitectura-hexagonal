<?php

namespace Src\Pharmacies\Pharmacy\Infrastructure\EloquentModels;

use Database\Factories\PharmacyEloquentModelFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharmacyEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'pharmacies';

    protected $fillable = [
        'id',
        'name',
        'address',
        'latitude',
        'longitude'
    ];

    public array $rules = [
        'name' => 'required',
        'address' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
    ];

    protected static function newFactory()
    {
        return PharmacyEloquentModelFactory::new();
    }
}
