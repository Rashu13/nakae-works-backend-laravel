<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    use HasFactory;
    protected $table = 'user_addresses';
    protected $fillable = ['user_id', 'address_type', 'full_name', 'phone', 'house_no', 'landmark', 'address', 'state_id', 'state_name', 'city_id', 'city_name', 'pincode', 'is_default', 'status'];
}

