<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function login_page(Request $request)
    {



        return response()->json([
            'success' => true,

            'message' => "Get method not allow !",
        ]);
    }
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => auth('api')->user()
        ]);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'in_hash_enc' => base64_encode(base64_encode($request->password))
        ]);
        // Generate User Code
        $user->user_code = 'USR' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
        $user->save();
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'message' => 'Registration Successful',
            'token' => $token,
            'user' => $user
        ]);
    }
    public function profile()
    {
        return response()->json(auth('api')->user());
    }
    public function profileUpdate(Request $request)
    {
        $user = auth('api')->user();

        $request->validate([
            'name'          => 'required|string|max:255',
            'latitude'      => 'nullable|numeric',
            'longitude'     => 'nullable|numeric',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Update basic details
        $user->name = $request->name;

        // Update Location
        if ($request->has('latitude')) {
            $user->latitude = $request->latitude;
        }

        if ($request->has('longitude')) {
            $user->longitude = $request->longitude;
        }

        // Upload Profile Image
        if ($request->hasFile('profile_image')) {

            // Delete old image
            if (
                $user->profile_image &&
                File::exists(public_path($user->profile_image))
            ) {
                File::delete(public_path($user->profile_image));
            }

            $file = $request->file('profile_image');

            $filename = time() . '_' . rand(1000, 9999) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/user'),
                $filename
            );

            $user->profile_image = 'uploads/user/' . $filename;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',

            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'latitude' => $user->latitude,
                'longitude' => $user->longitude,

                'profile_image' => $user->profile_image
                    ? asset($user->profile_image)
                    : null,
            ]

        ], 200);
    }
    public function updateDeviceToken(Request $request)
    {
        $user = auth('api')->user();

        $request->validate([
            'device_token' => 'required',
        ]);

        try {

            $user->device_token = $request->device_token;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User Device Token updated successfully.',
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteAccount(Request $request)
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        try {
            \App\Models\AddressModel::where('user_id', $user->id)->delete();
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Your customer account and associated personal data have been permanently deleted.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete account: ' . $e->getMessage()
            ], 500);
        }
    }
}
