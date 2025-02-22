<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneratorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'model' => $this->model,
            'watt' => $this->watt,
            'fuelType' => $this->fuel_type,
            'brand' => $this->brand_id,
            'image' => $this->image,
            'generatorPrice' => $this->generator_price,
            'description' => $this->description
        ];
    }
}
