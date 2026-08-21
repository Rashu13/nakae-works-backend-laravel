<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    protected $fillable = [
        'category_id',
        'sub_category_name',
        'name',
        'slug',
        'icon',
        'image',
        'desc',
        'description',
        'price',
        'base_price',
        'discount',
        'duration',
        'status',
        'sort_order',
        'visiting_fee',
        'tax_rate',
        'tax_type',
        'service_charge',
        'delivery_charge',
        'delivery_charge_type',
        'commission_value',
        'commission_type',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }

    // Used by Vendor Services
    public function vendorServices()
    {
        return $this->hasMany(VendorServiceModel::class, 'sub_category_id');
    }

    // Used by Service Requests
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequestModel::class, 'sub_category_id');
    }
}
