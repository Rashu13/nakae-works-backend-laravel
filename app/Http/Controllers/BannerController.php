<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerModel;
use App\Models\ContactDeatilModel;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = BannerModel::latest()->get();

        return view('banner', compact('banners'));
    }

    public function addBannerPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $imageName = time() . '_banner_' . Str::random(5) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $imageName);

            $imagePath = 'uploads/' . $imageName;
        }

        BannerModel::create([
            'image' => $imagePath,
            'status' => 1,
        ]);

        return back()->with('success', 'Banner Added Successfully.');
    }
    public function deleteBanner($id)
    {
        $banner = BannerModel::findOrFail($id);

        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }

        $banner->delete();

        return back()->with('success', 'Banner Deleted Successfully.');
    }

    public function changeStatus($id)
    {
        $banner = BannerModel::findOrFail($id);
        if ($banner->status == 1) {
            $banner->status = 0;
        } else {
            $banner->status = 1;
        }
        $banner->save();

        return back()->with('success', 'Banner Status Updated Successfully.');
    }

    public function contactDetails()
    {
        $detail = ContactDeatilModel::first();

        return view('contactDeatil', compact('detail'));
    }
    public function editContactDetails(Request $request)
    {
        $request->validate([
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'phone3' => 'nullable|string|max:20',
            'email'  => 'required|email|max:255',
            'fcm_server_key' => 'nullable|string',
            'fcm_sender_id'  => 'nullable|string',
            'fcm_project_id' => 'nullable|string',
            'fcm_json_file'  => 'nullable|file|mimes:json|max:1024',
        ]);

        $detail = ContactDeatilModel::first();

        if (!$detail) {
            $detail = new ContactDeatilModel();
        }

        $detail->phone1 = $request->phone1;
        $detail->phone2 = $request->phone2;
        $detail->phone3 = $request->phone3;
        $detail->email  = $request->email;
        $detail->fcm_server_key = $request->fcm_server_key;
        $detail->fcm_sender_id  = $request->fcm_sender_id;
        $detail->fcm_project_id = $request->fcm_project_id;

        if ($request->hasFile('fcm_json_file')) {
            $file = $request->file('fcm_json_file');
            $filename = 'firebase_credentials_' . time() . '.json';
            $file->move(storage_path('app/firebase'), $filename);
            $detail->fcm_json_path = 'storage/app/firebase/' . $filename;
        }

        $detail->save();

        return redirect()->back()->with('success', 'App settings & Firebase FCM keys updated successfully.');
    }
}
