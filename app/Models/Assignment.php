<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'anesthesiologist_id',
        'practicioner_id',
        'schedule_id',
        'start',
        'end'
    ];

    public function practicioner()
    {
        return $this->belongsTo(User::class,'practicioner_id');
    }

    public function anesthesiologist()
    {
        return $this->belongsTo(User::class,'anesthesiologist_id');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }



}
