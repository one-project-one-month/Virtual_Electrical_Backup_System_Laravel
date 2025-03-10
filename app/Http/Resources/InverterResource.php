<?php

namespace App\Http\Resources;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\InverterType\InverterTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InverterResource extends JsonResource
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
            'watt' => $this->watt,
            'inverterTypeId' => $this->inverter_type_id? InverterTypeResource::make($this->inverterType) : null,
            'brandId' => $this->brand_id ? BrandResource::make($this->brand) : null,
            'waveType' => $this->wave_type,
            'model' => $this->model,
            'inverterVolt' => $this->inverter_volt,
            'compatibleBattery' => $this->compatible_battery,
            'inverterPrice' => $this->inverter_price,
            'image' => $this->image? asset('storage/images/'.$this->image): null,
            'description' => $this->description,
        ];
    }
}
