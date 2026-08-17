<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDeatilModel extends Model
{
    use HasFactory;
    protected $table = 'admin_contacts';
    protected $fillable = [
        'phone1',
        'phone2',
        'phone3',
        'email',
        'fcm_server_key',
        'fcm_sender_id',
        'fcm_project_id',
        'fcm_json_path',
    ];
}
