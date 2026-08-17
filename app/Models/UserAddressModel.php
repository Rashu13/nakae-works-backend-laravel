<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddressModel extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    protected $fillable = [
        'user_id',
        'address_type',
        'full_name',
        'phone',
        'house_no',
        'landmark',
        'address',
        'state_id',
        'state_name',
        'city_id',
        'city_name',
        'pincode',
        'is_default',
        'status',
    ];

      // Address belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Address belongs to State
    public function state()
    {
        return $this->belongsTo(StateModel::class, 'state_id', 'id');
    }

    // Address belongs to City
    public function city()
    {
        return $this->belongsTo(CityModel::class, 'city_id', 'id');
    }
}
