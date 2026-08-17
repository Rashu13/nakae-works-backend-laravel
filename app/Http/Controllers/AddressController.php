<?php

namespace App\Http\Controllers;

// use App\Models\MasterStateModel;
// use App\Models\MasterCityModel;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function allAddresses(Request $request)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $addresses = $user->addresses()->get();

        return response()->json([
            'success' => true,
            'data' => $addresses
        ]);
    }
    // public function allMasterStates(Request $request)
    // {

    //     $states = MasterStateModel::orderBy('name')->get();

    //     return response()->json([
    //         'success' => true,
    //         'data' => $states
    //     ]);
    // }
    // public function allMasterCities($state_id)
    // {

    //     $cities = MasterCityModel::where('state_id', $state_id)->orderBy('city')->get();

    //     return response()->json([
    //         'success' => true,
    //         'data' => $cities
    //     ]);
    // }
    public function addAddress(Request $request)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->validate([
            'address_type' => 'required|string|max:50',
            'full_name'    => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'house_no'     => 'required|string|max:255',
            'landmark'     => 'nullable|string|max:255',
            'address'      => 'required|string',
            'state_id'     => 'required|integer',
            'state_name'   => 'nullable|string|max:255',
            'city_id'      => 'required|integer',
            'city_name'    => 'nullable|string|max:255',
            'pincode'      => 'required|string|max:10',
            'is_default'   => 'nullable|in:0,1',
            'status'       => 'nullable|in:0,1',
        ]);

        // Agar ye default address hai to purane default hata do
        if ($request->is_default == 1) {
            $user->addresses()->update([
                'is_default' => 0
            ]);
        }

        $address = $user->addresses()->create([
            'user_id'      => $user->id,
            'address_type' => $request->address_type,
            'full_name'    => $request->full_name,
            'phone'        => $request->phone,
            'house_no'     => $request->house_no,
            'landmark'     => $request->landmark,
            'address'      => $request->address,
            'state_id'     => $request->state_id,
            'state_name'   => $request->state_name,
            'city_id'      => $request->city_id,
            'city_name'    => $request->city_name,
            'pincode'      => $request->pincode,
            'is_default'   => $request->is_default ?? 0,
            'status'       => $request->status ?? 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address added successfully.',
            'data'    => $address
        ], 201);
    }
    public function updateAddress(Request $request, $id)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $address = $user->addresses()->find($id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ], 404);
        }

        $request->validate([
            'address_type' => 'required|string|max:50',
            'full_name'    => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'house_no'     => 'required|string|max:255',
            'landmark'     => 'nullable|string|max:255',
            'address'      => 'required|string',
            'state_id'     => 'required|integer',
            'state_name'   => 'nullable|string|max:255',
            'city_id'      => 'required|integer',
            'city_name'    => 'nullable|string|max:255',
            'pincode'      => 'required|string|max:10',
            'is_default'   => 'nullable|in:0,1',
            'status'       => 'nullable|in:0,1',
        ]);

        // Agar ye default address hai to purane default hata do
        if ($request->is_default == 1) {
            $user->addresses()->update([
                'is_default' => 0
            ]);
        }

        $address->update([
            'address_type' => $request->address_type,
            'full_name'    => $request->full_name,
            'phone'        => $request->phone,
            'house_no'     => $request->house_no,
            'landmark'     => $request->landmark,
            'address'      => $request->address,
            'state_id'     => $request->state_id,
            'state_name'   => $request->state_name,
            'city_id'      => $request->city_id,
            'city_name'    => $request->city_name,
            'pincode'      => $request->pincode,
            'is_default'   => $request->is_default ?? 0,
            'status'       => $request->status ?? 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully.',
            'data'    => $address
        ]);
    }
    public function deleteAddress($id)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $address = $user->addresses()->find($id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ], 404);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully.'
        ]);
    }
}
