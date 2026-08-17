<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestModel extends Model
{
    use HasFactory;
    protected $table = "service_requests";

    protected $fillable = [
        'request_code',
        'user_id',
        'vendor_id',
        'category_id',
        'sub_category_id',
        'address_id',
        'review_status',
        'problem_description',
        'vendor_remark',
        'user_cancel_remark',
        'preferred_date',
        'preferred_time',
        'budget',
        'latitude',
        'longitude',
        'status',
    ];

    // User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Vendor
    public function vendor()
    {
        return $this->belongsTo(VendorModel::class, 'vendor_id');
    }

    // Category
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    // Sub Category
    public function subCategory()
    {
        return $this->belongsTo(SubCategoryModel::class, 'sub_category_id');
    }
    public function address()
    {
        return $this->belongsTo(AddressModel::class, 'address_id');
    }
    public function requestImages()
    {
        return $this->hasMany(RequestImagesModel::class, 'request_id', 'id');
    }
    public function messages()
    {
        return $this->hasMany(RequestMessagesModel::class, 'request_id');
    }
    public function review()
    {
        return $this->hasOne(ReviewModel::class, 'request_id', 'id');
    }
}
