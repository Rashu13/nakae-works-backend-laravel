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
        'discount_percent',
        'discount_amount',
        'offer_badge',
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
