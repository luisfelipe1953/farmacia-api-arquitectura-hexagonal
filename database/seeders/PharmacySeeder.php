<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Src\Pharmacies\Pharmacy\Infrastructure\EloquentModels\PharmacyEloquentModel;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PharmacyEloquentModel::factory(15)->create();
    }
}
