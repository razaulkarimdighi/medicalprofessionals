<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Schedule extends Model
{
    use HasFactory;
    public const FILE_STORE_HONORARY_PATH = 'file';

    public const ASSIGNED_SCHEDULE = 'assigned';
    public const NOT_ASSIGNED_SCHEDULE    = 'not_assigned';
    protected $fillable = [
        'start',
        'end',
        'honorary_note',
        'user_id',
        'anesthesiology_type',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
