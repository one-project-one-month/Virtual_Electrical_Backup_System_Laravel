<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    /** @use HasFactory<\Database\Factories\BatteryFactory> */
    use HasFactory;

    protected $table = 'batteries';

    protected $fillable = ['storage_amp', 'battery_volt', 'image', 'description', 'battery_type_id'];

    public function BatteryType()
    {
        $this->belongsTo(BatteryType::class, 'battery_type_id', 'id');
    }
}