<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FanHistory extends Model
{
    protected $fillable = ['fan_id', 'temperature', 'is_on', 'speed', 'note', 'recorded_at'];

    protected $casts = [
        'temperature' => 'float',
        'is_on' => 'boolean',
        'speed' => 'integer',
        'recorded_at' => 'datetime',
    ];

    public function fan(): BelongsTo
    {
        return $this->belongsTo(Fan::class);
    }
}
