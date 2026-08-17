<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'coupon_code',
        'discount_type',
        'discount_value',
        'max_discount_amount',
        'min_booking_amount',
        'total_usage_limit',
        'used_count',
        'start_date',
        'expiry_date',
        'status',
    ];

    public function getIsExpiredAttribute()
    {
        if (!$this->expiry_date) return false;
        return now()->gt($this->expiry_date);
    }

    public function getIsLimitReachedAttribute()
    {
        return $this->used_count >= $this->total_usage_limit;
    }
}
