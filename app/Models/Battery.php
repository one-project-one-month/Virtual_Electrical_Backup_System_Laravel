<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    /** @use HasFactory<\Database\Factories\BatteryFactory> */
    use HasFactory;

    protected $table = 'batteries';

    protected $fillable = ['battery_name', 'storage_amp', 'battery_volt', 'battery_price', 'image', 'description', 'brand_id', 'battery_type_id'];

    public function BatteryType()
    {
        return $this->belongsTo(BatteryType::class, 'battery_type_id', 'id');
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
