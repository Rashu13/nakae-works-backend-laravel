<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\AppVersionModel;
use App\Models\StateModel;
use App\Models\CityModel;
use App\Models\ContactDeatilModel;
use App\Models\VendorModel;

class APIController extends Controller
{
    public function categoriesList()
    {
        $categories = CategoryModel::where('status', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('category_name', 'ASC')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Category List',
            'data' => $categories
        ], 200);
    }
    public function subcategoriesList()
    {
        $subCategories = SubCategoryModel::with('category')
            ->where('status', 1)
            ->orderBy('sub_category_name', 'ASC')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Sub Category List',
            'data' => $subCategories
        ], 200);
    }
    public function subcategoriesbyCate($id)
    {
        $subCategories = SubCategoryModel::where('category_id', $id)->with('category')
            ->where('status', 1)
            ->orderBy('sub_category_name', 'ASC')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Sub Category List by Category',
            'data' => $subCategories
        ], 200);
    }
    public function statesList()
    {
        $states = StateModel::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'State List',
            'data'    => $states
        ], 200);
    }
    public function contactDetails()
    {
        $detail = ContactDeatilModel::first();

        if (!$detail) {
            return response()->json([
                'status'  => false,
                'message' => 'Contact details not found.',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Contact Details',
            'data'    => $detail
        ], 200);
    }
    public function citiesList($state_id)
    {
        $cities = CityModel::where('state_id', $state_id)
            ->where('status', 1)
            ->orderBy('city_name', 'ASC')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'City List',
            'data'    => $cities
        ], 200);
    }
    public function vendorsByCity($city)
    {
        $vendors = VendorModel::with([
            'state',
            'city',
            'services.category',
            'services.subCategory',
        ])
            ->where('city_id', $city)
            ->where('status', 'approved')
            ->where('is_verified', 1)
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Vendor List',
            'data'    => $vendors
        ], 200);
    }
    public function vendorsByCitySubcategory($city, $subCategoryId)
    {
        $vendors = VendorModel::with([
            'state',
            'city',
            'services.category',
            'services.subCategory',
        ])
            ->where('city_id', $city)
            ->where('status', 'approved')
            ->where('is_verified', 1)
            ->whereHas('services', function ($query) use ($subCategoryId) {
                $query->where('sub_category_id', $subCategoryId);
            })
            ->orderBy('name', 'ASC')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Vendor List',
            'data'    => $vendors
        ], 200);
    }



    public function searchCategories(Request $request)
    {
        $keyword = trim($request->search);

        if (empty($keyword)) {
            return response()->json([
                'status' => false,
                'message' => 'Search keyword is required.',
                'data' => []
            ], 400);
        }

        $categories = CategoryModel::with(['subCategories' => function ($q) use ($keyword) {
            $q->where('status', 1)
                ->where('sub_category_name', 'LIKE', "%{$keyword}%");
        }])
            ->where('status', 1)
            ->where(function ($q) use ($keyword) {

                $q->where('category_name', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('subCategories', function ($sub) use ($keyword) {
                        $sub->where('status', 1)
                            ->where('sub_category_name', 'LIKE', "%{$keyword}%");
                    });
            })
            ->orderBy('sort_order')
            ->orderBy('category_name')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Search Result',
            'data'    => $categories
        ], 200);
    }

    public function allBanners()
    {
        $banners = BannerModel::orderBy('id', 'desc')->where('status', 1)->get();
        return response()->json([
            'status'  => true,
            'message' => 'Banner List',
            'data'    => $banners
        ], 200);
    }

    public function promotedAds(Request $request)
    {
        $today = now()->toDateString();
        $query = \App\Models\VendorPromotionModel::with(['vendor', 'subCategory', 'city'])
            ->where('status', 1)
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $today);
            });

        if ($request->filled('placement')) {
            $query->where('placement', $request->placement);
        }

        if ($request->filled('city_id')) {
            $query->where(function($q) use ($request) {
                $q->whereNull('city_id')->orWhere('city_id', $request->city_id);
            });
        }

        $ads = $query->latest()->get();

        return response()->json([
            'status'  => true,
            'message' => 'Active Promoted Vendor Ads',
            'data'    => $ads
        ], 200);
    }
    public function apiListFile()
    {
        $data = [

            [
                'name' => 'Category List',
                'method' => 'GET',
                'url' => url('/api/category-list'),
                'description' => 'Get all active categories.'
            ],

            [
                'name' => 'Sub Category List',
                'method' => 'GET',
                'url' => url('/api/sub-category-list/{category_id}'),
                'description' => 'Get active sub categories by category id.'
            ],

            [
                'name' => 'State List',
                'method' => 'GET',
                'url' => url('/api/state-list'),
                'description' => 'Get all active states.'
            ],

            [
                'name' => 'City List',
                'method' => 'GET',
                'url' => url('/api/city-list/{state_id}'),
                'description' => 'Get active cities by state id.'
            ],
            [
                'name' => 'Subcategory List By Category',
                'method' => 'GET',
                'url' => url('/api/subcategory-list-by-categroy/{id}'),
                'description' => 'Get all subcategories by category ID.'
            ],
            [
                'name' => 'Promoted Vendor Ads',
                'method' => 'GET',
                'url' => url('/api/promoted-ads?placement=home_banner'),
                'description' => 'Get active vendor sponsored banners and promoted listings (placement params: home_banner, category_top, city_featured).'
            ],
            [
                'name' => 'Available Promo Coupons',
                'method' => 'GET',
                'url' => url('/api/available-coupons'),
                'description' => 'Get active valid customer discount coupons.'
            ],
            [
                'name' => 'Apply Promo Coupon',
                'method' => 'POST',
                'url' => url('/api/apply-coupon'),
                'description' => 'Validate & apply coupon code. Body params: { coupon_code: "WELCOME50", booking_amount: 500 }'
            ],
            [
                'name' => 'Vendors By City',
                'method' => 'GET',
                'url' => url('/api/vendors-by-city/{cityId}'),
                'description' => 'Get all vendors by city ID.'
            ],
            [
                'name' => 'Vendors By City & Subcategory',
                'method' => 'GET',
                'url' => url('/api/vendors-by-city-subcategroy/{cityId}/{subCategroyId}'),
                'description' => 'Get vendors by city ID and subcategory ID.'
            ],
            [
                'name' => 'All Banners',
                'method' => 'GET',
                'url' => url('/api/all-banners'),
                'description' => 'Get all active banners.'
            ],
            [
                'name' => 'Search Categories',
                'method' => 'GET',
                'url' => url('/api/search-category'),
                'description' => 'Search categories by keyword.'
            ],

            [
                'name' => 'User Register',
                'method' => 'POST',
                'url' => url('/api/register'),
                'description' => 'Register a new user account.'
            ],

            [
                'name' => 'User Login',
                'method' => 'POST',
                'url' => url('/api/login'),
                'description' => 'Login user and return JWT access token.'
            ],

            [
                'name' => 'User Profile',
                'method' => 'GET',
                'url' => url('/api/profile'),
                'description' => 'Get logged-in user profile. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'User Profile Update',
                'method' => 'PUT',
                'url' => url('/api/update-profile'),
                'description' => 'Update logged-in user profile. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'All User Addresses',
                'method' => 'GET',
                'url' => url('/api/all-address'),
                'description' => 'Get all addresses of the logged-in user. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Add User Address',
                'method' => 'POST',
                'url' => url('/api/add-address'),
                'description' => 'Add a new address for the logged-in user. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Update User Address',
                'method' => 'PUT',
                'url' => url('/api/update-address/{id}'),
                'description' => 'Update an existing address of the logged-in user. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Delete User Address',
                'method' => 'DELETE',
                'url' => url('/api/delete-address/{id}'),
                'description' => 'Delete an address of the logged-in user. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Book Service',
                'method' => 'POST',
                'url' => url('/api/book-service'),
                'description' => 'Create a new service booking. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'My Bookings',
                'method' => 'GET',
                'url' => url('/api/my-bookings'),
                'description' => 'Get all service bookings of the logged-in user. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Cancel Booking',
                'method' => 'POST',
                'url' => url('/api/cancel-booking/{id}'),
                'description' => 'Cancel booking  of the logged-in user. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Booking Details',
                'method' => 'GET',
                'url' => url('/api/booking-details/{id}'),
                'description' => 'Get details of a specific booking by ID. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'All Notifications',
                'method' => 'GET',
                'url' => url('/api/all-notifications'),
                'description' => 'Get all notifications of the logged-in user. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'View Notification',
                'method' => 'GET',
                'url' => url('/api/notification-view/{id}'),
                'description' => 'Mark a specific notification as read and get its details. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Add Review',
                'method' => 'POST',
                'url' => url('/api/add-review/{id}'),
                'description' => 'Add a review for the completed service request.'
            ],
            [
                'name' => 'Edit Review',
                'method' => 'POST',
                'url' => url('/api/edit-review/{id}'),
                'description' => 'Edit an existing review.'
            ],
            [
                'name' => 'Review Details',
                'method' => 'GET',
                'url' => url('/api/review-details/{id}'),
                'description' => 'Get details of a specific review.'
            ],
            [
                'name' => 'My Reviews',
                'method' => 'GET',
                'url' => url('/api/my-reviews'),
                'description' => 'Get all reviews submitted by the logged-in user.'
            ],
            [
                'name' => 'Delete Review',
                'method' => 'GET',
                'url' => url('/api/delete-review/{id}'),
                'description' => 'Delete a review submitted by the logged-in user.'
            ],
            [
                'name' => 'Update Device Token',
                'method' => 'GET',
                'url' => url('/api/user/update-device-token'),
                'description' => 'Update Device Token logged-in user.'
            ],
            [
                'name' => 'Delete Customer Account (Play Store Mandatory)',
                'method' => 'POST',
                'url' => url('/api/delete-account'),
                'description' => 'Permanently delete customer account and associated personal data. Authorization: Bearer Token required.'
            ],

        ];


        $dataVendor = [

            [
                'name' => 'Vendor Register',
                'method' => 'POST',
                'url' => url('/api/vendor/register'),
                'description' => 'Register a new vendor account.'
            ],

            [
                'name' => 'Vendor Login',
                'method' => 'POST',
                'url' => url('/api/vendor/login'),
                'description' => 'Login vendor and return JWT token.'
            ],

            [
                'name' => 'Complete Profile',
                'method' => 'POST',
                'url' => url('/api/vendor/complete-profile'),
                'description' => 'Complete vendor profile after registration. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Vendor Profile',
                'method' => 'GET',
                'url' => url('/api/vendor/profile'),
                'description' => 'Get logged-in vendor profile. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Update Vendor Profile',
                'method' => 'POST',
                'url' => url('/api/vendor/update-profile'),
                'description' => 'Update logged-in vendor profile. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Vendor Logout',
                'method' => 'POST',
                'url' => url('/api/vendor/logout'),
                'description' => 'Logout vendor. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Vendor Services',
                'method' => 'GET',
                'url' => url('/api/vendor/services'),
                'description' => 'Get vendor selected services. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Vendor Notifications',
                'method' => 'GET',
                'url' => url('/api/vendor/all-notifications'),
                'description' => 'Get all vendor notifications. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'View Vendor Notification',
                'method' => 'GET',
                'url' => url('/api/vendor/notification-view/{id}'),
                'description' => 'Mark a specific vendor notification as read and get its details. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Booking Requests',
                'method' => 'GET',
                'url' => url('/api/vendor/booking-requests'),
                'description' => 'Get all booking requests assigned to vendor. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Booking Details',
                'method' => 'GET',
                'url' => url('/api/vendor/booking-details/{id}'),
                'description' => 'Get booking details by booking ID. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Accept Booking',
                'method' => 'POST',
                'url' => url('/api/vendor/accept-booking/{id}'),
                'description' => 'Accept a pending booking request. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Reject Booking',
                'method' => 'POST',
                'url' => url('/api/vendor/reject-booking/{id}'),
                'description' => 'Reject a pending booking request. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'On The Way',
                'method' => 'POST',
                'url' => url('/api/vendor/on-the-way/{id}'),
                'description' => 'Update booking status to On The Way. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Start Service',
                'method' => 'POST',
                'url' => url('/api/vendor/start-service/{id}'),
                'description' => 'Update booking status to Started. Authorization: Bearer Token required.'
            ],

            [
                'name' => 'Complete Service',
                'method' => 'POST',
                'url' => url('/api/vendor/complete-service/{id}'),
                'description' => 'Mark booking as completed. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Vendor Review List',
                'method' => 'GET',
                'url' => url('/api/vendor/review-list'),
                'description' => 'Get all reviews received by the logged-in vendor.'
            ],
            [
                'name' => 'Vendor Review Details',
                'method' => 'GET',
                'url' => url('/api/vendor/review-details/{id}'),
                'description' => 'Get details of a specific review received by the logged-in vendor.'
            ],
            [
                'name' => 'Update Vendor Availability',
                'method' => 'POST',
                'url' => url('/api/vendor/update-availability'),
                'description' => 'Update the availability status of the logged-in vendor. Available values: available, busy, offline.'
            ],
            [
                'name' => 'Add Vendor Services',
                'method' => 'POST',
                'url' => url('/api/vendor/add-service'),
                'description' => 'Add services for the logged-in vendor. Send services as an array in the format category_id|sub_category_id, for example: ["1|5", "1|6", "2|8"].'
            ],

            [
                'name' => 'Edit Vendor Services',
                'method' => 'POST',
                'url' => url('/api/vendor/edit-service'),
                'description' => 'Update services for the logged-in vendor. Existing services will be removed and replaced with the submitted services. Send services as an array in the format category_id|sub_category_id, for example: ["1|5", "3|10", "3|11"].'
            ],
            [
                'name' => 'All Complete Requests',
                'method' => 'GET',
                'url' => url('/api/vendor/all-complete-requests'),
                'description' => 'Get all completed service requests for the logged-in vendor. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'All Complete Requests Count',
                'method' => 'GET',
                'url' => url('/api/vendor/all-complete-requests-count'),
                'description' => 'Get the total count of completed service requests for the logged-in vendor. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Today Pending Requests',
                'method' => 'GET',
                'url' => url('/api/vendor/today-pending-requests'),
                'description' => 'Get all pending service requests scheduled for today for the logged-in vendor. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Today Pending Requests Count',
                'method' => 'GET',
                'url' => url('/api/vendor/today-pending-requests-count'),
                'description' => 'Get the total count of pending service requests scheduled for today for the logged-in vendor. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Today Accepted Requests',
                'method' => 'GET',
                'url' => url('/api/vendor/today-accepted-requests'),
                'description' => 'Get all accepted service requests scheduled for today for the logged-in vendor. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Today Accepted Requests Count',
                'method' => 'GET',
                'url' => url('/api/vendor/today-accepted-requests-count'),
                'description' => 'Get the total count of accepted service requests scheduled for today for the logged-in vendor. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Vendor Device Token ',
                'method' => 'GET',
                'url' => url('/api/vendor/update-device-token'),
                'description' => 'Update Device Token logged-in vendor. Authorization: Bearer Token required.'
            ],
            [
                'name' => 'Delete Vendor Account (Play Store Mandatory)',
                'method' => 'POST',
                'url' => url('/api/vendor/delete-account'),
                'description' => 'Permanently delete vendor partner account and associated listings. Authorization: Bearer Token required.'
            ],

        ];


        $web = [
            [
                'name' => 'Contact Details',
                'method' => 'GET',
                'url' => url('/api/contact-deatils'),
                'description' => 'Get contact details information.'
            ],
            [
                'name' => 'Reviews by Subcategory',
                'method' => 'GET',
                'url' => url('/api/vendor/reviews-by-subcategory/{subCategory}/{vendorID}'),
                'description' => 'Get all reviews for a specific vendor filtered by subcategory.'
            ],
            [
                'name' => 'Reviews by Vendor',
                'method' => 'GET',
                'url' => url('/api/vendor/reviews-by-vendor/{vendorID}'),
                'description' => 'Get all reviews submitted for a specific vendor, including user and service request details.'
            ],
            [
                'name' => 'Vendor Average Rating',
                'method' => 'GET',
                'url' => url('/api/vendor/reviews-by-vendor-avg/{vendorID}'),
                'description' => 'Get the average rating of a specific vendor based on all reviews. The average rating is returned from 1.0 to 5.0.'
            ],
        ];

        return response()->json([
            'status' => true,
            'message' => 'NAKAE Works Mistri API Documentation',
            'version' => '1.0',
            'base_url' => url('/api'),

            'user_api_count' => count($data),
            'vendor_api_count' => count($dataVendor),
            'web_apis_count' => count($web),

            'user_apis' => $data,
            'vendor_apis' => $dataVendor,
            'web_apis' => $web,

        ], 200);
    }
    public function appVersion()
    {
        $version = AppVersionModel::orderBy('id', 'desc')->first();

        return response()->json([
            'status'  => true,
            'message' => 'App Version',
            'data'    => $version
        ], 200);
    }

    public function apiDocumentationPage()
    {
        $res = $this->apiListFile()->getData(true);
        $userApis   = $res['user_apis'] ?? [];
        $vendorApis = $res['vendor_apis'] ?? [];
        $webApis    = $res['web_apis'] ?? [];

        return view('apiDocs', compact('userApis', 'vendorApis', 'webApis'));
    }
}
