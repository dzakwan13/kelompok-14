<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FanHistory extends Model
{
    protected $fillable = [
        'fan_id',
        'temperature',
        'status',
        'speed',
    ];

    public function fan(): BelongsTo
    {
        return $this->belongsTo(Fan::class);
    }
}