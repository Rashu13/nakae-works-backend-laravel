<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['category_name', 'category_icon', 'category_image', 'sort_order','in_home', 'status'];

    // One Category -> Many Sub Categories
    public function subCategories()
    {
        return $this->hasMany(SubCategoryModel::class, 'category_id', 'id');
    }

    // One Category -> Many Vendor Services
    public function vendorServices()
    {
        return $this->hasMany(VendorServiceModel::class, 'category_id', 'id');
    }

    // One Category -> Many Service Requests
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequestModel::class, 'category_id', 'id');
    }
}
