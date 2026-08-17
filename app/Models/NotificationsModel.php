<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationsModel extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_type',
        'user_id',
        'title',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Customer Relation
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Vendor Relation
     */
    public function vendor()
    {
        return $this->belongsTo(VendorModel::class, 'user_id');
    }

    /**
     * Admin Relation
     */
    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'user_id');
    }
}
