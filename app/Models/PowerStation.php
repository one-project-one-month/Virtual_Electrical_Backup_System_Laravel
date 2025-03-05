<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PowerStation extends Model
{
    protected $fillable = [
        'watt',
        'brand_id',
        'wave_type',
        'model',
        'usable_watt',
        'charging_time',
        'charging_type',
        'input_watt',
        'input_amp',
        'output_amp',
        'power_station_price',
        'image',
        'description'
    ];

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
