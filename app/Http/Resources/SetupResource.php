<?php

namespace App\Http\Resources;

use App\Http\Resources\InverterResource;
use App\Http\Resources\BatteryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SetupResource extends JsonResource
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
            'inverter' => InverterResource::make($this->inverter),
            'battery' => BatteryResource::make($this->battery),
            'totalWatt' => $this->total_watt,
            'setupPrice' => $this->setup_price
        ];
    }
}
