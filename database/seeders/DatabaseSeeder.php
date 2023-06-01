<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Factories\PharmacyEloquentModelFactory;
use Src\Pharmacies\Pharmacy\Infrastructure\EloquentModels\PharmacyEloquentModel;

class DatabaseSeeder extends Seeder
{   
    protected $factories = [
        PharmacyEloquentModel::class => PharmacyEloquentModelFactory::class,
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('admin')
        // ]);

        $this->call(PharmacySeeder::class);

    }
}
