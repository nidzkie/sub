<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'student_id',
        'phone_number',
        'course',
        'year_level',
        'campus',
        'department',
        'bio',
        'rating',
        'is_verified_student',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified_student' => 'boolean',
        ];
    }

    // Relationships
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'renter_id');
    }

    // Helper methods
    public function getAverageRatingAttribute()
    {
        return (float) ($this->rating ?? 0);
    }

    public function isStudentVerified()
    {
        return $this->is_verified_student;
    }
}
