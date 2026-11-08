<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fan extends Model
{
    protected $fillable = ['name', 'device_code', 'temperature', 'is_on', 'speed', 'threshold'];

    protected $casts = [
        'temperature' => 'float',
        'is_on' => 'boolean',
        'speed' => 'integer',
        'threshold' => 'float',
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(FanHistory::class);
    }
}
