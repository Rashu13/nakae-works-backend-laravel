<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $fillable = ['name', 'status','in_home'];
     // State ke andar multiple Cities
    public function cities()
    {
        return $this->hasMany(CityModel::class, 'state_id', 'id');
    }

    // State ke andar multiple User Addresses
    public function addresses()
    {
        return $this->hasMany(UserAddressModel::class, 'state_id', 'id');
    }

    // State ke users
    public function users()
    {
        return $this->hasMany(User::class, 'state_id', 'id');
    }
}
