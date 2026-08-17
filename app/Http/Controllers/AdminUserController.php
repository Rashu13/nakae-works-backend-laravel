<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class AdminUserController extends Controller
{
    public function userList()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('userList', compact('users'));
    }
    public function userView($id)
    {
        $user = User::with([
            'serviceRequests.category',
            'serviceRequests.subCategory',
            'serviceRequests.vendor'
        ])->findOrFail($id);

        return view('userView', compact('user'));
    }
    public function userEditPage($id)
    {
        $states = StateModel::where('status', 1)->orderBy('name')->get();

        $user = User::with([
            'addresses.state',
            'addresses.city'
        ])->findOrFail($id);

        return view('userEdit', compact('user', 'states'));
    }
    public function userEditPost(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'phone'         => 'nullable|string|max:20',
            'latitude'      => 'nullable',
            'longitude'     => 'nullable',
            'status'        => 'required|in:0,1',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Profile Image Upload
        if ($request->hasFile('profile_image')) {

            // Delete old image
            if ($user->profile_image && File::exists(public_path($user->profile_image))) {
                File::delete(public_path($user->profile_image));
            }

            $file = $request->file('profile_image');
            $filename = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/user'), $filename);

            $user->profile_image = 'uploads/user/' . $filename;
        }

        // Update Data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->status = $request->status;

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }
}
