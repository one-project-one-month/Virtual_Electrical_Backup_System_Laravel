<?php

namespace App\Models\ElectricalAccessory;

use Illuminate\Database\Eloquent\Model;

class ElectricalAccessory extends Model
{
    protected $fillable=['device_name','watt','pure_sine_wave','image'];
}
