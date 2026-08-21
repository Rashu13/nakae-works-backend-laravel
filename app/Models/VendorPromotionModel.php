<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPromotionModel extends Model
{
    use HasFactory;

    protected $table = 'vendor_promotions';

    protected $fillable = [
        'vendor_id',
        'sub_category_id',
        'city_id',
        'title',
        'banner_image',
        'placement',
        'coupon_code',
        'discount_type',
        'discount_percent',
        'discount_amount',
        'original_price',
        'offer_price',
        'offer_badge',
        'max_uses_per_user',
        'total_usage_limit',
        'min_order_amount',
        'terms_note',
        'start_date',
        'end_date',
        'price',
        'status',
    ];

    public function vendor()
    {
        return $this->belongsTo(VendorModel::class, 'vendor_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategoryModel::class, 'sub_category_id');
    }

    public function city()
    {
        return $this->belongsTo(CityModel::class, 'city_id');
    }

    public function getIsExpiredAttribute()
    {
        if (!$this->end_date) return false;
        return now()->gt($this->end_date);
    }
}
