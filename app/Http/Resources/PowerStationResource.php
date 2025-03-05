<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\Brand\BrandResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PowerStationResource extends JsonResource
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
            'waveType' => $this->wave_type,
            'model' => $this->model,
            'usableWatt' => $this->usable_watt,
            'chargingTime' => $this->charging_time,
            'chargingType' => $this->charging_type,
            'inputWatt' => $this->input_watt,
            'inputAmp' => $this->input_amp,
            'outputAmp' => $this->output_amp,
            'powerStationPrice' => $this->power_station_price,
            'image' =>  $this->image,
            'description' => $this->description,
            'brand' => BrandResource::make($this->brand)
        ];
    }
}
