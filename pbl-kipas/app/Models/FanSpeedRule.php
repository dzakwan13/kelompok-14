<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FanSpeedRule extends Model
{
    protected $fillable = [
        'fan_setting_id',
        'temperature_threshold',
        'fan_speed',
    ];

    public function setting(): BelongsTo
    {
        return $this->belongsTo(FanSetting::class, 'fan_setting_id');
    }
}
