<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setup extends Model
{
    protected $fillable = [
        'inverter_id',
        'battery_id',
        'total_watt',
        'usage_time',
        'setup_price'
    ];

    public function inverter():BelongsTo
    {
        return $this->belongsTo(Inverter::class);
    }

    public function battery():BelongsTo
    {
        return $this->belongsTo(Battery::class);
    }
}
