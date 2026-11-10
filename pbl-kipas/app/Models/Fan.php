<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fan extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'device_id',
        'status',
        'speed',
    ];

    public function setting(): HasOne
    {
        return $this->hasOne(FanSetting::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(FanHistory::class);
    }
}