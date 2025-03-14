<?php

namespace App\Http\Resources\ElectricalAccessory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElectircalAccessoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'device_name'=>$this->device_name,
            'watt'=>$this->watt,
            'pure_sine_wave'=>$this->pure_sine_wave,
            'image'=>$this->image
        ];
    }
}
