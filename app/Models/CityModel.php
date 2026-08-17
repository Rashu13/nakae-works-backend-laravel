<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = ['state_id', 'city_name', 'status'];
   // City belongs to State
    public function state()
    {
        return $this->belongsTo(StateModel::class, 'state_id', 'id');
    }

    // City ke User Addresses
    public function addresses()
    {
        return $this->hasMany(UserAddressModel::class, 'city_id', 'id');
    }

    // City ke users
    public function users()
    {
        return $this->hasMany(User::class, 'city_id', 'id');
    }
}
