<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalculationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'runTime' => ($this->hours > 0 ? "{$this->hours} hours" . ($this->minutes > 0 ? " and " : "") : "") . ($this->minutes > 0 ? "{$this->minutes} minutes" : "")
        ];
    }
}