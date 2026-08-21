<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\VendorModel;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Models\VendorServiceModel;
use App\Models\NotificationsModel;
use App\Models\ServiceRequestModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ReviewModel;

class VendorController extends Controller
{
    public function login(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth('vendor')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'token' => $token,
            'vendor' => auth('vendor')->user()
        ], 200);
    }

    public function profile()
    {
        return response()->json([
            'success' => true,
            'vendor' => auth('vendor')->user()
        ]);
    }

    public function logout()
    {
        auth('vendor')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout Successfully'
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'required|unique:vendors,phone',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $vendor = VendorModel::create([
            'vendor_code' => '',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'in_hash' => base64_encode(base64_encode($request->password)),
            'status' => 0,
            'is_verified' => 0,
            'profile_completed' => 0,
        ]);

        $vendor->vendor_code = 'VEN' . str_pad($vendor->id, 4, '0', STR_PAD_LEFT);
        $vendor->save();

        $token = JWTAuth::fromUser($vendor);

        return response()->json([
            'success' => true,
            'message' => 'Registration Successful',
            'token' => $token,
            'vendor' => $vendor
        ]);
    }

    public function completeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dob' => 'required|date',
            'gender' => 'required',
            'aadhaar_number' => 'required|unique:vendors,aadhaar_number,' . auth('vendor')->id(),
            'aadhaar_front' => 'required|image',
            'aadhaar_back' => 'required|image',
            'profile_image' => 'required|image',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'experience_year' => 'required|numeric',
            'availability' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $vendor = auth('vendor')->user();

            $age = Carbon::parse($request->dob)->age;

            // Profile Image
            if ($request->hasFile('profile_image')) {

                $file = $request->file('profile_image');

                $name = time() . '_profile.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/vendors'), $name);

                $vendor->profile_image = 'uploads/vendors/' . $name;
            }

            // Aadhaar Front
            if ($request->hasFile('aadhaar_front')) {

                $file = $request->file('aadhaar_front');

                $name = time() . '_front.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/vendors'), $name);

                $vendor->aadhaar_front = 'uploads/vendors/' . $name;
            }

            // Aadhaar Back
            if ($request->hasFile('aadhaar_back')) {

                $file = $request->file('aadhaar_back');

                $name = time() . '_back.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/vendors'), $name);

                $vendor->aadhaar_back = 'uploads/vendors/' . $name;
            }

            $vendor->dob = $request->dob;
            $vendor->age = $age;
            $vendor->gender = $request->gender;
            $vendor->aadhaar_number = $request->aadhaar_number;
            $vendor->state_id = $request->state_id;
            $vendor->city_id = $request->city_id;
            $vendor->address = $request->address;
            $vendor->latitude = $request->latitude;
            $vendor->longitude = $request->longitude;
            $vendor->experience_year = $request->experience_year;
            $vendor->about = $request->about;
            $vendor->availability = $request->availability;
            $vendor->start_time = $request->start_time;
            $vendor->end_time = $request->end_time;
            $vendor->profile_completed = 0;

            $vendor->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profile Completed Successfully'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function addService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'services' => 'required|array|min:1',
            'services.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $vendor = auth('vendor')->user();

            foreach ($request->services as $service) {

                $parts = explode('|', $service);

                if (count($parts) != 2) {
                    continue;
                }

                $categoryId = $parts[0];
                $subcategoryId = $parts[1];

                VendorServiceModel::create([
                    'vendor_id'       => $vendor->id,
                    'category_id'     => $categoryId,
                    'sub_category_id' => $subcategoryId,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vendor services added successfully'
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function editAddedService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'services'   => 'required|array|min:1',
            'services.*' => 'required|string',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $vendor = auth('vendor')->user();

            /*
        |--------------------------------------------------------------------------
        | Delete Old Services
        |--------------------------------------------------------------------------
        */

            VendorServiceModel::where(
                'vendor_id',
                $vendor->id
            )->delete();


            /*
        |--------------------------------------------------------------------------
        | Insert New Services
        |--------------------------------------------------------------------------
        */

            foreach ($request->services as $service) {

                $parts = explode('|', $service);

                if (count($parts) != 2) {
                    continue;
                }

                $categoryId = $parts[0];
                $subcategoryId = $parts[1];

                VendorServiceModel::create([
                    'vendor_id'       => $vendor->id,
                    'category_id'     => $categoryId,
                    'sub_category_id' => $subcategoryId,
                ]);
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vendor services updated successfully'
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function getServices()
    {
        $vendor = auth('vendor')->user();

        $services = VendorServiceModel::with(['category', 'subcategory'])->where('vendor_id', $vendor->id)->get();

        return response()->json([
            'success' => true,
            'services' => $services
        ]);
    }
    public function updateProfile(Request $request)
    {
        $vendor = auth('vendor')->user();

        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:255',
            'phone'             => 'required|unique:vendors,phone,' . $vendor->id,
            'alternate_phone'   => 'nullable',
            'email'             => 'required|email|unique:vendors,email,' . $vendor->id,
            'password'          => 'nullable|min:6',
            'dob'               => 'required|date',
            'gender'            => 'required',
            'aadhaar_number'    => 'required|unique:vendors,aadhaar_number,' . $vendor->id,
            'aadhaar_front'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'aadhaar_back'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'profile_image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'state_id'          => 'required',
            'city_id'           => 'required',
            'address'           => 'required',
            'experience_year'   => 'required|numeric',
            'availability'      => 'required',
            'services'          => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $vendor->age = Carbon::parse($request->dob)->age;

            // Aadhaar Front
            if ($request->hasFile('aadhaar_front')) {

                $file = $request->file('aadhaar_front');

                $name = time() . '_front_' . Str::random(5) . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/vendors'), $name);

                $vendor->aadhaar_front = 'uploads/vendors/' . $name;
            }

            // Aadhaar Back
            if ($request->hasFile('aadhaar_back')) {

                $file = $request->file('aadhaar_back');

                $name = time() . '_back_' . Str::random(5) . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/vendors'), $name);

                $vendor->aadhaar_back = 'uploads/vendors/' . $name;
            }

            // Profile Image
            if ($request->hasFile('profile_image')) {

                $file = $request->file('profile_image');

                $name = time() . '_profile_' . Str::random(5) . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/vendors'), $name);

                $vendor->profile_image = 'uploads/vendors/' . $name;
            }

            // Password Update
            if ($request->filled('password')) {

                $vendor->password = Hash::make($request->password);
                $vendor->in_hash = base64_encode(base64_encode($request->password));
            }

            // Update Details
            $vendor->name = $request->name;
            $vendor->phone = $request->phone;
            $vendor->alternate_phone = $request->alternate_phone;
            $vendor->email = $request->email;
            $vendor->dob = $request->dob;
            $vendor->gender = $request->gender;
            $vendor->aadhaar_number = $request->aadhaar_number;
            $vendor->state_id = $request->state_id;
            $vendor->city_id = $request->city_id;
            $vendor->address = $request->address;
            $vendor->latitude = $request->latitude;
            $vendor->longitude = $request->longitude;
            $vendor->experience_year = $request->experience_year;
            $vendor->about = $request->about;
            $vendor->availability = $request->availability;
            $vendor->start_time = $request->start_time;
            $vendor->end_time = $request->end_time;

            // Admin fields ko touch nahi karna
            // status
            // is_verified
            // vendor_code

            $vendor->save();

            // Services Update
            VendorServiceModel::where('vendor_id', $vendor->id)->delete();

            foreach ($request->services as $service) {

                list($category_id, $sub_category_id) = explode('|', $service);

                VendorServiceModel::create([
                    'vendor_id' => $vendor->id,
                    'category_id' => $category_id,
                    'sub_category_id' => $sub_category_id,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profile Updated Successfully.',
                'vendor' => $vendor->load('services')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function allNotifications()
    {
        $user = auth('vendor')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $notifications = NotificationsModel::where('user_type', 'vendor')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Notifications fetched successfully.',
            'total' => $notifications->count(),
            'data' => $notifications
        ], 200);
    }
    public function notificationView($id)
    {
        $vendor = auth('vendor')->user();

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $notification = NotificationsModel::where('id', $id)
            ->where('user_type', 'vendor')
            ->where('user_id', $vendor->id)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.'
            ], 404);
        }

        // Mark as read
        $notification->is_read = 1;
        $notification->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification viewed successfully.',
            'data' => $notification
        ], 200);
    }
    public function bookingRequests()
    {
        $vendor = auth('vendor')->user();

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $bookings = ServiceRequestModel::with([
            'user',
            'category',
            'subCategory',
            'address',
            'requestImages'
        ])
            ->where('vendor_id', $vendor->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Booking list fetched successfully.',
            'total' => $bookings->count(),
            'data' => $bookings
        ]);
    }
    public function bookingDetails($id)
    {
        $vendor = auth('vendor')->user();

        $booking = ServiceRequestModel::with([
            'user',
            'category',
            'subCategory',
            'address',
            'requestImages',
            'review'
        ])
            ->where('vendor_id', $vendor->id)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $booking
        ]);
    }
    public function acceptBooking(Request $request, $id)
    {
        $vendor = auth('vendor')->user();

        $booking = ServiceRequestModel::where('vendor_id', $vendor->id)
            ->where('status', 'pending')
            ->findOrFail($id);

        $booking->status = 'accepted';
        $booking->vendor_remark = $request->vendor_remark;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Booking Accepted Successfully.',
            'data' => $booking
        ]);
    }
    public function rejectBooking(Request $request, $id)
    {
        $vendor = auth('vendor')->user();

        $booking = ServiceRequestModel::where('vendor_id', $vendor->id)
            ->where('status', 'pending')
            ->findOrFail($id);

        $booking->status = 'rejected';
        $booking->vendor_remark = $request->vendor_remark;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Booking Rejected Successfully.',
            'data' => $booking
        ]);
    }
    public function onTheWay(Request $request, $id)
    {
        $vendor = auth('vendor')->user();

        $booking = ServiceRequestModel::where('vendor_id', $vendor->id)
            ->where('status', 'accepted')
            ->findOrFail($id);

        $booking->status = 'on_the_way';
        $booking->vendor_remark = $request->vendor_remark;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Vendor is on the way.',
            'data' => $booking
        ]);
    }
    public function startService(Request $request, $id)
    {
        $vendor = auth('vendor')->user();

        $booking = ServiceRequestModel::where('vendor_id', $vendor->id)->findOrFail($id);

        $booking->status = 'started';
        $booking->vendor_remark = $request->vendor_remark;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Service Started.',
            'data' => $booking
        ]);
    }
    public function completeService(Request $request, $id)
    {
        $vendor = auth('vendor')->user();

        $booking = ServiceRequestModel::where('vendor_id', $vendor->id)
            ->where('status', 'started')
            ->findOrFail($id);

        $booking->status = 'completed';
        $booking->vendor_remark = $request->vendor_remark;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Service Completed.',
            'data' => $booking
        ]);
    }
    public function updateAvailability(Request $request)
    {
        $vendor = auth('vendor')->user();

        $request->validate([
            'availability' => 'required|in:available,busy,offline',
        ]);

        try {

            $vendor->availability = $request->availability;
            $vendor->save();

            return response()->json([
                'success' => true,
                'message' => 'Availability updated successfully.',
                'availability' => $vendor->availability,
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function updateDeviceToken(Request $request)
    {
        $vendor = auth('vendor')->user();

        $request->validate([
            'device_token' => 'required',
        ]);

        try {

            $vendor->device_token = $request->device_token;
            $vendor->save();

            return response()->json([
                'success' => true,
                'message' => 'Venor Device Token updated successfully.',
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function reviewsBySubCatgory($subCategory, $vendorID)
    {
        $reviews = ReviewModel::with([
            'user',
            'serviceRequest'
        ])
            ->where('vendor_id', $vendorID)
            ->where('status', 1)
            ->whereHas('serviceRequest', function ($query) use ($subCategory) {
                $query->where('sub_category_id', $subCategory);
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Reviews by subcategory',
            'data' => $reviews
        ], 200);
    }

    public function reviewsByVendor($vendorID)
    {
        $reviews = ReviewModel::with([
            'user',
            'serviceRequest'
        ])
            ->where('vendor_id', $vendorID)
            ->where('status', 1)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'All Reviews',
            'data' => $reviews
        ], 200);
    }
    public function reviewsByAvg($vendorID)
    {
        $averageRating = ReviewModel::where('vendor_id', $vendorID)
            ->where('status', 1)
            ->avg('rating');
        $ratingCount = ReviewModel::where('vendor_id', $vendorID)
            ->where('status', 1)
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Vendor Average Rating',
            'data' => [
                'vendor_id' => $vendorID,
                'average_rating' => number_format((float) $averageRating, 1),
                'ratingCount' => $ratingCount
            ]
        ], 200);
    }

    public function deleteAccount(Request $request)
    {
        $vendor = auth('vendor')->user();
        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Vendor not authenticated'
            ], 401);
        }

        try {
            VendorServiceModel::where('vendor_id', $vendor->id)->delete();
            $vendor->delete();

            return response()->json([
                'success' => true,
                'message' => 'Your vendor partner account and associated service listing have been permanently deleted.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete vendor account: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createPromotion(Request $request)
    {
        $vendor = auth('vendor')->user();
        if (!$vendor) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'title'        => 'required|string|max:255',
            'placement'    => 'required|in:home_banner,category_top,city_featured',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'banner_image' => 'nullable|image|max:4096',
        ]);

        $imagePath = null;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = 'ad_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banner_images'), $filename);
            $imagePath = 'uploads/banner_images/' . $filename;
        }

        $promo = \App\Models\VendorPromotionModel::create([
            'vendor_id'       => $vendor->id,
            'sub_category_id' => $request->sub_category_id,
            'city_id'          => $request->city_id ?? $vendor->city_id,
            'title'           => $request->title,
            'banner_image'    => $imagePath,
            'placement'       => $request->placement,
            'start_date'      => $request->start_date ?? now()->toDateString(),
            'end_date'        => $request->end_date ?? now()->addDays(30)->toDateString(),
            'price'           => $request->price ?? 0,
            'status'          => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Vendor Ad / Promotion submitted successfully.',
            'data'    => $promo
        ], 201);
    }
}

