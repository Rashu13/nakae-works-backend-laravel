<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMessagesModel extends Model
{
    use HasFactory;
    protected $table = 'request_messages';
    protected $fillable = ['request_id', 'sender_type', 'sender_id', 'message'];

    public function request()
    {
        return $this->belongsTo(ServiceRequestModel::class, 'request_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function vendor()
    {
        return $this->belongsTo(VendorModel::class, 'sender_id');
    }

    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'sender_id');
    }
}
