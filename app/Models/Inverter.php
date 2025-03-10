<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\InverterType\InverterType;

class Inverter extends Model
{
    //
    protected $fillable = [
        'watt',
        'inverter_type_id',
        'brand_id',
        'wave_type',
        'model',
        'inverter_volt',
        'compatible_battery',
        'inverter_price',
        'image',
        'description'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function inverterType()
    {
        return $this->belongsTo(InverterType::class, 'inverter_type_id', 'id');
    }
}
