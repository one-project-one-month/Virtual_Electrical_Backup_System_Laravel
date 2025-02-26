<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Generator extends Model
{
    protected $fillable = [
        'name',
        'model',
        'watt',
        'fuel_type',
        'brand_id',
        'image',
        'generator_price',
        'description'
    ];

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
