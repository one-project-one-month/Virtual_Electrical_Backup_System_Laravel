<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryType extends Model
{
    /** @use HasFactory<\Database\Factories\BatterTypeFactory> */
    use HasFactory;

    protected $table = 'battery_types';

    protected $fillable = ['battery_type_name', 'percentage'];

    public function Batteries()
    {
        return $this->hasMany(Battery::class, 'id', 'battery_type_id');
    }
}