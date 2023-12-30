<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const FILE_STORE_PATH = 'users_avatar';
    public const FILE_STORE_HONORARY_PATH = 'honorary';
    public const USER_TYPE_ADMIN    = 'admin';
    public const USER_TYPE_MEDICAL_PRACTICES    = 'medical_practices';
    public const USER_TYPE_ANESTHEIOLOGISTS    = 'anesthesiologists';

    protected $appends = ['full_name', 'avatar_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'location',
        'honorary_note',
        'email',
        'phone',
        'user_type',
        'anesthesiologist_type',
        'permission',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatarUrlAttribute()
    {
        return get_storage_image(self::FILE_STORE_PATH, $this->avatar, 'user');
    }

    public function practitionerAssignments(){
        return $this->hasMany(Assignment::class,'practitioner_id');
    }

    public function anesthesiologistAssignments(){
        return $this->hasMany(Assignment::class,'anesthesiologist_id');
    }
}
