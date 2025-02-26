<?php

namespace App\Http\Resources;

use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
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
            'image' => $this->getUrl($this->image),
            'generatorPrice' => $this->generator_price,
            'description' => $this->description,

            'brand' => BrandResource::make($this->brand)
        ];
    }

    private function getUrl($path)
    {
        return $path ? asset('storage/images/generators/' . $path) : null;
    }
}
