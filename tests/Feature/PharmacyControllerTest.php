<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Pharmacies\Pharmacy\Domain\Factories\PharmacyFactory;
use Src\Pharmacies\Pharmacy\Application\Mappers\PharmacyMapper;

class PharmacyControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $pharmacies_uri;
    private $nearby;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pharmacies_uri = '/api/pharmacies';
        $this->nearby = $this->pharmacies_uri . '/nearby';
    }

    public function createRandomNote($pharmacyNumber = 1): array
    {
        $pharmacy_ids = [];
        foreach (range(1, $pharmacyNumber) as $_) {
            $note = PharmacyFactory::new();
            $pharmacyEloquent = PharmacyMapper::toEloquent($note);
            $pharmacyEloquent->save();

            $pharmacy_ids[] = $pharmacyEloquent->id;
        }
        return $pharmacy_ids;
    }

    // /** @test */
    // public function can_retrieve_neart_pharmacies()
    // {
    //     $this->withoutExceptionHandling();

    //     $pharmacyNumber = $this->faker->numberBetween(1, 5);
    //     $this->createRandomNote($pharmacyNumber);

    //     $this->post('api/pharmacies/nearby', [

    //     ])
    //      ->assertOk();
    // }
    
    /** @test */
    public function can_retrieve_all_pharmacies()
    {
        $this->withoutExceptionHandling();

        $pharmacyNumber = $this->faker->numberBetween(1, 5);
        $this->createRandomNote($pharmacyNumber);

        $this->get($this->pharmacies_uri)
            ->assertOk();
    }

    /** @test */
    public function can_get_specific_pharmacy_by_id()
    {
        $pharmacyNumber = $this->faker->numberBetween(1, 10);
        $pharmacy_ids = $this->createRandomNote($pharmacyNumber);
        $ramdomId = $this->faker->randomElement($pharmacy_ids);

        $this->get($this->pharmacies_uri . '/' . $ramdomId)
            ->assertOk()
            ->assertJsonStructure(['farmacia' => ['id', 'name', 'address', 'latitude', 'longitude']]);
    }

    /** @test */
    public function can_create_a_pharmacy()
    {
        $this->withoutExceptionHandling();

        $requestBody = [
            'name' => $this->faker->name,
            'address' => $this->faker->lastname,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $this->post($this->pharmacies_uri, $requestBody)
            ->assertOk()
            ->assertJson(["msg" => "Se ha creado satisfactoriamente."]);
    }

    /** @test */
    public function can_update_any_pharmcy()
    {
        $this->withoutExceptionHandling();

        $pharmacyNumber = $this->faker->numberBetween(1, 10);
        $pharmacy_ids = $this->createRandomNote($pharmacyNumber);
        $ramdomId = $this->faker->randomElement($pharmacy_ids);

        $requestBody = [
            'name' => $this->faker->name,
            'address' => $this->faker->lastname,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];

        $this->put($this->pharmacies_uri . '/' . $ramdomId, $requestBody)
            ->assertOk()
            ->assertJson(["msg" => "Se ha actualizado satisfactoriamente."]);
    }

    /** @test */
    public function can_delete_a_pharmacy()
    {
        $this->withoutExceptionHandling();

        $pharmacyNumber = $this->faker->numberBetween(1, 10);

        $pharmacy_ids = $this->createRandomNote($pharmacyNumber);

        $ramdomId = $this->faker->randomElement($pharmacy_ids);

        $this->delete($this->pharmacies_uri . '/' . $ramdomId)
            ->assertOk()
            ->assertJson(["msg" => "Se ha eliminado satisfactoriamente."]);

        $this->get($this->pharmacies_uri . '/' . $ramdomId)
            ->assertJson(['error' => 'Problema inesperado al procesar la solicitud.']);
    }

    /** @test */
    public function cannot_delete_pharmcy_if_does_not_exists()
    {
        $this->withoutExceptionHandling();

        $this->delete($this->pharmacies_uri . '/' . 949)
            ->assertJson(['error' => 'Problema inesperado al procesar la solicitud.']);
    }
}
