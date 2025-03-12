<?php

namespace App\Http\Resources;

use App\Http\Resources\Brand\BrandResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class BatteryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'batteryName' => $this->battery_name,
            'storageAmp' => $this->storage_amp,
            'batteryVolt' => $this->battery_volt,
            'batteryPrice' => $this->battery_price,
            'image' => $this->image ? Storage::url($this->image) : null,
            'description' => $this->description,
            'brand' => BrandResource::make($this->brand),
            'batteryType' => BatteryTypeResource::make($this->batterytype),
        ];
    }
}
