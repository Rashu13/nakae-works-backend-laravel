<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStateModel extends Model
{
    use HasFactory;
    protected $table = 'master_states';
    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(MasterCityModel::class, 'state_id', 'id');
    }

   
}
