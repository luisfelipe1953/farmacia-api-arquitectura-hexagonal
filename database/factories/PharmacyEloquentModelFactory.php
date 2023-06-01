<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Pharmacies\Pharmacy\Infrastructure\EloquentModels\PharmacyEloquentModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PharmacyEloquentModelFactory extends Factory
{   

    protected $model = PharmacyEloquentModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $monteriaColombiaLatitude = [
            4.710989,
            6.244203,
            3.420556,
            10.413730,
            7.891239,
            2.927299,
            6.335192,
            5.068890,
            7.134010,
            8.757452,
            4.570868,
            3.437220,
            6.243254,
            4.814278,
            7.876867,
            6.459034,
            3.421580,
            6.311631,
            2.448564,
            5.070740,        
        ];
        
        $monteriaColombiaLongitude = [
            -74.072090,
            -75.581211,
            -76.527222,
            -75.529080,
            -72.507361,
            -75.281960,
            -75.568840,
            -75.517280,
            -73.081890,
            -75.894510,
            -74.297333,
            -76.522499,
            -75.569157,
            -75.694496,
            -72.496400,
            -75.598512,
            -76.534210,
            -75.566811,
            -73.851434,
            -75.510811,
        ];
        
        return [
            'name' => $this->faker->unique()->company(),
            'address' => $this->faker->unique()->address(),
            'latitude' => $this->faker->unique()->randomElement($monteriaColombiaLatitude),
            'longitude' => $this->faker->unique()->randomElement($monteriaColombiaLongitude),
        ];
    }
}
