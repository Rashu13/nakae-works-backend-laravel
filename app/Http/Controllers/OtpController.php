<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Services\SmsService;
use App\Models\User;
use App\Models\VendorModel;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OtpController extends Controller
{
    /**
     * Generate & Send OTP to Mobile Number via SMS Gateway
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'  => 'required|numeric|digits_between:10,12',
            'type'   => 'nullable|string|in:login,register,login_register',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }

        // Generate 4-digit random numeric OTP
        $otp = (string) rand(1000, 9999);

        // Store OTP in Cache for 10 minutes (600 seconds)
        Cache::put('otp_' . $phone, $otp, 600);

        // Send OTP via Infrainfotech SMS Gateway
        $smsResult = SmsService::sendOtp($phone, $otp);

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully to mobile number',
            'phone'   => $phone,
        ], 200);
    }

    /**
     * Verify OTP Code (Strict Verification - No Fallbacks)
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits_between:10,12',
            'otp'   => 'required|string|min:4|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }

        $inputOtp  = trim($request->otp);
        $cachedOtp = Cache::get('otp_' . $phone);

        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired or was not requested. Please request a new OTP.'
            ], 400);
        }

        if ($cachedOtp !== $inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code. Please try again.'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
            'phone'   => $phone,
        ], 200);
    }

    /**
     * Login via OTP (Customer)
     */
    public function loginWithOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits_between:10,12',
            'otp'   => 'required|string|min:4|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }

        $inputOtp  = trim($request->otp);
        $cachedOtp = Cache::get('otp_' . $phone);

        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired or was not requested.'
            ], 400);
        }

        if ($cachedOtp !== $inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code.'
            ], 400);
        }

        // Search user by phone number
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'success'       => true,
                'is_registered' => false,
                'message'       => 'OTP verified successfully, but no account found for this phone number. Please complete registration.',
                'phone'         => $phone
            ], 200);
        }

        // Clear OTP Cache upon successful verification
        Cache::forget('otp_' . $phone);

        // Generate JWT Token
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success'       => true,
            'is_registered' => true,
            'message'       => 'Login successful',
            'token'         => $token,
            'user'          => $user
        ], 200);
    }

    /**
     * Register via OTP (Customer)
     */
    public function registerWithOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'phone'    => 'required|numeric|digits_between:10,12|unique:users,phone',
            'email'    => 'required|email|unique:users,email',
            'otp'      => 'required|string|min:4|max:6',
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }

        $inputOtp  = trim($request->otp);
        $cachedOtp = Cache::get('otp_' . $phone);

        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired or was not requested.'
            ], 400);
        }

        if ($cachedOtp !== $inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code.'
            ], 400);
        }

        $plainPassword = $request->password ?? '123456';

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $phone,
            'password'    => Hash::make($plainPassword),
            'in_hash_enc' => base64_encode(base64_encode($plainPassword))
        ]);

        $user->user_code = 'USR' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
        $user->save();

        Cache::forget('otp_' . $phone);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'token'   => $token,
            'user'    => $user
        ], 201);
    }

    /**
     * Send OTP for Vendor
     */
    public function sendVendorOtp(Request $request)
    {
        return $this->sendOtp($request);
    }

    /**
     * Verify OTP for Vendor
     */
    public function verifyVendorOtp(Request $request)
    {
        return $this->verifyOtp($request);
    }

    /**
     * Login via OTP (Vendor)
     */
    public function loginVendorWithOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits_between:10,12',
            'otp'   => 'required|string|min:4|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }

        $inputOtp  = trim($request->otp);
        $cachedOtp = Cache::get('otp_' . $phone);

        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired or was not requested.'
            ], 400);
        }

        if ($cachedOtp !== $inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code.'
            ], 400);
        }

        $vendor = VendorModel::where('phone', $phone)->first();

        if (!$vendor) {
            return response()->json([
                'success'       => true,
                'is_registered' => false,
                'message'       => 'OTP verified successfully, but no vendor account found for this phone number. Please complete registration.',
                'phone'         => $phone
            ], 200);
        }

        Cache::forget('otp_' . $phone);

        $token = JWTAuth::fromUser($vendor);

        return response()->json([
            'success'       => true,
            'is_registered' => true,
            'message'       => 'Vendor Login successful',
            'token'         => $token,
            'vendor'        => $vendor
        ], 200);
    }

    /**
     * Register via OTP (Vendor)
     */
    public function registerVendorWithOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'phone'    => 'required|numeric|digits_between:10,12|unique:vendors,phone',
            'email'    => 'required|email|unique:vendors,email',
            'otp'      => 'required|string|min:4|max:6',
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }

        $inputOtp  = trim($request->otp);
        $cachedOtp = Cache::get('otp_' . $phone);

        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired or was not requested.'
            ], 400);
        }

        if ($cachedOtp !== $inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code.'
            ], 400);
        }

        $plainPassword = $request->password ?? '123456';

        $vendor = VendorModel::create([
            'vendor_code'       => '',
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $phone,
            'password'          => Hash::make($plainPassword),
            'in_hash'           => base64_encode(base64_encode($plainPassword)),
            'status'            => 'pending',
            'is_verified'       => 0,
            'profile_completed' => 0,
        ]);

        $vendor->vendor_code = 'VEN' . str_pad($vendor->id, 4, '0', STR_PAD_LEFT);
        $vendor->save();

        Cache::forget('otp_' . $phone);

        $token = JWTAuth::fromUser($vendor);

        return response()->json([
            'success' => true,
            'message' => 'Vendor Registration successful',
            'token'   => $token,
            'vendor'  => $vendor
        ], 201);
    }
}
