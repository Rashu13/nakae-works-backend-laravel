<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class VendorModel extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    protected $table = 'vendors';

    protected $fillable = [
        'vendor_code',
        'name',
        'phone',
        'alternate_phone',
        'email',
        'password',
        'dob',
        'age',
        'gender',
        'aadhaar_number',
        'aadhaar_front',
        'aadhaar_back',
        'profile_image',
        'state_id',
        'city_id',
        'address',
        'latitude',
        'longitude',
        'experience_year',
        'about',
        'availability',
        'is_verified',
        'status',
        'in_hash',
        'last_active_at',
        'start_time',
        'end_time',
        'profile_completed',
        'device_token',
    ];

    protected $hidden = [
        'password',
        'in_hash',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
    // State
    public function state()
    {
        return $this->belongsTo(StateModel::class, 'state_id');
    }

    // City
    public function city()
    {
        return $this->belongsTo(CityModel::class, 'city_id');
    }

    // Services
    public function services()
    {
        return $this->hasMany(VendorServiceModel::class, 'vendor_id');
    }

    // Service Requests
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequestModel::class, 'vendor_id');
    }
    public function notifications()
    {
        return $this->hasMany(NotificationsModel::class, 'user_id')
            ->where('user_type', 'vendor');
    }
    public function reviews()
{
    return $this->hasMany(ReviewModel::class, 'vendor_id');
}
}
