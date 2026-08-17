<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\StateModel;
use App\Models\VendorModel;
use Illuminate\Http\Request;
use App\Models\VendorServiceModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function vendorsList()
    {
        $vendors = VendorModel::orderBy('id', 'desc')->get();

        return view('vendorsList', compact('vendors'));
    }
    public function vendorsAdd()
    {
        $states = StateModel::where('status', 1)->orderBy('name')->get();

        $categories = CategoryModel::where('status', 1)
            ->with(['subCategories' => function ($q) {
                $q->where('status', 1);
            }])
            ->orderBy('sort_order')
            ->get();

        return view('addVendor', compact(
            'states',
            'categories'
        ));
    }
    public function vendorsAddPost(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|unique:vendors,phone',
            'alternate_phone'   => 'nullable',
            'email'             => 'required|email|unique:vendors,email',
            'password'          => 'required|min:6',
            'dob'               => 'required|date',
            'gender'            => 'required',
            'aadhaar_number'    => 'required|unique:vendors,aadhaar_number',
            'state_id'          => 'required',
            'city_id'           => 'required',
            'address'           => 'required',
            'experience_year'   => 'required|numeric',
            'availability'      => 'required',
            'status'            => 'required',
            'is_verified'       => 'required',
        ]);

        DB::beginTransaction();

        try {

            $age = Carbon::parse($request->dob)->age;

            $aadhaarFront = null;
            if ($request->hasFile('aadhaar_front')) {

                $file = $request->file('aadhaar_front');
                $aadhaarFront = time() . '_front_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vendors'), $aadhaarFront);

                $aadhaarFront = 'uploads/vendors/' . $aadhaarFront;
            }

            $aadhaarBack = null;
            if ($request->hasFile('aadhaar_back')) {

                $file = $request->file('aadhaar_back');
                $aadhaarBack = time() . '_back_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vendors'), $aadhaarBack);

                $aadhaarBack = 'uploads/vendors/' . $aadhaarBack;
            }

            $profileImage = null;
            if ($request->hasFile('profile_image')) {

                $file = $request->file('profile_image');
                $profileImage = time() . '_profile_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vendors'), $profileImage);

                $profileImage = 'uploads/vendors/' . $profileImage;
            }

            $vendor = VendorModel::create([

                'vendor_code'      => '',
                'name'             => $request->name,
                'phone'            => $request->phone,
                'alternate_phone'  => $request->alternate_phone,
                'email'            => $request->email,
                'password'         => Hash::make($request->password),
                'in_hash'          => base64_encode(base64_encode($request->password)),
                'dob'              => $request->dob,
                'age'              => $age,
                'gender'           => $request->gender,
                'aadhaar_number'   => $request->aadhaar_number,
                'aadhaar_front'    => $aadhaarFront,
                'aadhaar_back'     => $aadhaarBack,
                'profile_image'    => $profileImage,
                'state_id'         => $request->state_id,
                'city_id'          => $request->city_id,
                'address'          => $request->address,
                'latitude'         => $request->latitude,
                'longitude'        => $request->longitude,
                'experience_year'  => $request->experience_year,
                'about'            => $request->about,
                'availability'     => $request->availability,
                'is_verified'      => $request->is_verified,
                'status'           => $request->status,
                'last_active_at'   => now(),
                'start_time'       => $request->start_time,
                'end_time'         => $request->end_time,

            ]);

            // Vendor Code
            $vendor->vendor_code = 'VEN' . str_pad($vendor->id, 4, '0', STR_PAD_LEFT);
            $vendor->save();

            // Vendor Services
            if ($request->filled('services')) {

                foreach ($request->services as $service) {

                    [$category_id, $sub_category_id] = explode('|', $service);

                    VendorServiceModel::create([
                        'vendor_id'       => $vendor->id,
                        'category_id'     => $category_id,
                        'sub_category_id' => $sub_category_id,
                    ]);
                }
            }

            DB::commit();

            return back()->with('success', 'Vendor Added Successfully.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
    public function vendorView($id)
    {
        $vendor = VendorModel::with([

            // Vendor
            'state',
            'city',

            // Services Offered
            'services.category',
            'services.subCategory',

            // Service Requests
            'serviceRequests.user.state',
            'serviceRequests.user.city',
            'serviceRequests.category',
            'serviceRequests.subCategory',
            'serviceRequests.address',
            'serviceRequests.requestImages',
            'serviceRequests.messages',
            'serviceRequests.vendor',

        ])->findOrFail($id);

        return view('vendorView', compact('vendor'));
    }
    public function vendorVerifyState($id)
    {

        $vendor = VendorModel::findOrFail($id);
        if ($vendor->is_verified == 0) {
            $vendor->is_verified = 1;
        } else {
            $vendor->is_verified = 0;
        }
        $vendor->save();

        return back()->with('success', 'Vendor Verification Status Updated Successfully.');
    }
    public function profile_complete_status($id)
    {

        $vendor = VendorModel::findOrFail($id);
        if ($vendor->profile_completed == 0) {
            $vendor->profile_completed = 1;
        } else {
            $vendor->profile_completed = 0;
        }
        $vendor->save();

        return back()->with('success', 'Vendor Profile Complete Status Updated Successfully.');
    }
    public function editVendor($id)
    {
        $states = StateModel::where('status', 1)->orderBy('name')->get();

        $categories = CategoryModel::where('status', 1)
            ->with(['subCategories' => function ($q) {
                $q->where('status', 1);
            }])
            ->orderBy('sort_order')
            ->get();
        $vendor = VendorModel::with(['services'])->findOrFail($id);
        return view('editVendor', compact('vendor', 'states', 'categories'));
    }
    public function editVendorPost(Request $request, $id)
    {
       
        $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|unique:vendors,phone,' . $id,
            'alternate_phone'   => 'nullable',
            'email'             => 'required|email|unique:vendors,email,' . $id,
            'password'          => 'nullable|min:6', // Nullable so it only updates if provided
            'dob'               => 'required|date',
            'gender'            => 'required',
            'aadhaar_number'    => 'required|unique:vendors,aadhaar_number,' . $id,
            'state_id'          => 'required',
            'city_id'           => 'required',
            'address'           => 'required',
            'experience_year'   => 'required|numeric',
            'availability'      => 'required',
            'status'            => 'required',
            'is_verified'       => 'required',
        ]);

        DB::beginTransaction();

        try {
            $vendor = VendorModel::findOrFail($id);

            // Calculate age
            $age = \Carbon\Carbon::parse($request->dob)->age;

            // Handle File Uploads (Only replace if new file is selected)
            if ($request->hasFile('aadhaar_front')) {
                // Optional: You can add code to delete the old file here using unlink() or File::delete()
                $file = $request->file('aadhaar_front');
                $aadhaarFront = time() . '_front_' . \Illuminate\Support\Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vendors'), $aadhaarFront);
                $vendor->aadhaar_front = 'uploads/vendors/' . $aadhaarFront;
            }

            if ($request->hasFile('aadhaar_back')) {
                $file = $request->file('aadhaar_back');
                $aadhaarBack = time() . '_back_' . \Illuminate\Support\Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vendors'), $aadhaarBack);
                $vendor->aadhaar_back = 'uploads/vendors/' . $aadhaarBack;
            }

            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $profileImage = time() . '_profile_' . \Illuminate\Support\Str::random(5) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/vendors'), $profileImage);
                $vendor->profile_image = 'uploads/vendors/' . $profileImage;
            }

            // Update Password only if a new one is provided
            if ($request->filled('password')) {
                $vendor->password = \Illuminate\Support\Facades\Hash::make($request->password);
                $vendor->in_hash = base64_encode(base64_encode($request->password));
            }

            // Update basic details
            $vendor->name            = $request->name;
            $vendor->phone           = $request->phone;
            $vendor->alternate_phone = $request->alternate_phone;
            $vendor->email           = $request->email;
            $vendor->dob             = $request->dob;
            $vendor->age             = $age;
            $vendor->gender          = $request->gender;
            $vendor->aadhaar_number  = $request->aadhaar_number;
            $vendor->state_id        = $request->state_id;
            $vendor->city_id         = $request->city_id;
            $vendor->address         = $request->address;
            $vendor->latitude        = $request->latitude;
            $vendor->longitude       = $request->longitude;
            $vendor->experience_year = $request->experience_year;
            $vendor->about           = $request->about;
            $vendor->availability    = $request->availability;
            $vendor->is_verified     = $request->is_verified;
            $vendor->status          = $request->status;
            $vendor->start_time      = $request->start_time;
            $vendor->end_time        = $request->end_time;

            $vendor->save();

            // Handle Vendor Services Update
            // 1. Delete existing services for this vendor
            VendorServiceModel::where('vendor_id', $vendor->id)->delete();

            // 2. Insert updated services
            if ($request->filled('services')) {
                foreach ($request->services as $service) {
                    [$category_id, $sub_category_id] = explode('|', $service);

                    VendorServiceModel::create([
                        'vendor_id'       => $vendor->id,
                        'category_id'     => $category_id,
                        'sub_category_id' => $sub_category_id,
                    ]);
                }
            }

            DB::commit();

            return back()->with('success', 'Vendor Updated Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
