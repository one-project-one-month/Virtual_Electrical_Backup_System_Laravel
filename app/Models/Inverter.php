<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
