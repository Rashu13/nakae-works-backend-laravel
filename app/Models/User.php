<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_code',
        'name',
        'email',
        'phone',
        'password',
        'latitude',
        'longitude',
        'profile_image',
        'status',
        'in_hash_enc',
        'device_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'in_hash_enc',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    // State
    // public function state()
    // {
    //     return $this->belongsTo(StateModel::class, 'state_id');
    // }

    // // City
    // public function city()
    // {
    //     return $this->belongsTo(CityModel::class, 'city_id');
    // }

    // Service Requests
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequestModel::class, 'user_id');
    }

    // public function addresses()
    // {
    //     return $this->hasMany(UserAddressModel::class, 'user_id');
    // }
    public function notifications()
    {
        return $this->hasMany(NotificationsModel::class, 'user_id')
            ->where('user_type', 'customer');
    }
    public function reviews()
    {
        return $this->hasMany(ReviewModel::class, 'customer_id');
    }


      // User ka State
    public function state()
    {
        return $this->belongsTo(StateModel::class, 'state_id', 'id');
    }

    // User ka City
    public function city()
    {
        return $this->belongsTo(CityModel::class, 'city_id', 'id');
    }

    // User ke Addresses
    public function addresses()
    {
        return $this->hasMany(UserAddressModel::class, 'user_id', 'id');
    }
}
