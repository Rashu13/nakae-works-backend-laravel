<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestImagesModel extends Model
{
    use HasFactory;
    protected $table = 'request_images';
    protected $fillable = ['request_id', 'images'];

    public function request()
    {
        return $this->belongsTo(ServiceRequestModel::class, 'request_id');
    }
}
