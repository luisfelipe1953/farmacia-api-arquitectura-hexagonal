<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'pharmacy',
            'id' => $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->name,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            ],
            'links' => [
                'self' => route('pharmacy.show', $this->resource)
            ]
        ];
    }
}
