<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    protected $table = 'brands';

    public function Batteries()
    {
        return $this->hasMany(Battery::class, 'brand_id', 'id');
    }

    public function PowerStations()
    {
        return $this->hasMany(PowerStation::class, 'brand_id', 'id');
    }
}
