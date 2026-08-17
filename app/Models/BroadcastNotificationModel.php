<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadcastNotificationModel extends Model
{
    use HasFactory;

    protected $table = 'broadcast_notifications';

    protected $fillable = [
        'target_audience',
        'city_id',
        'title',
        'message',
        'image',
        'sent_count',
    ];

    public function city()
    {
        return $this->belongsTo(CityModel::class, 'city_id');
    }
}
