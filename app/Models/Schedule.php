<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'available_date',
        'start_time',
        'end_time',
        'user_id',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
