<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    protected $fillable = [
        'request_id',
        'customer_id',
        'vendor_id',
        'rating',
        'review',
        'comment',
        'status',
    ];

    // Customer
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Vendor
    public function vendor()
    {
        return $this->belongsTo(VendorModel::class, 'vendor_id');
    }

    // Service Request
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequestModel::class, 'request_id');
    }
}
