<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FanSetting extends Model
{
    protected $fillable = [
        'fan_id',
        'mode',
        'temperature_limit',
        'speed',
    ];

    public function fan(): BelongsTo
    {
        return $this->belongsTo(Fan::class);
    }

    public function speedRules(): HasMany
    {
        return $this->hasMany(FanSpeedRule::class);
    }
}