<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCityModel extends Model
{
    use HasFactory;
    protected $table = 'master_cities';
    protected $fillable = ['city', 'state_id'];

    public function state()
    {
        return $this->belongsTo(MasterStateModel::class, 'state_id', 'id');
    }

    
}
