<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorPromotionModel;
use App\Models\VendorModel;
use App\Models\SubCategoryModel;
use App\Models\CityModel;

class VendorPromotionController extends Controller
{
    public function index(Request $request)
    {
        $query = VendorPromotionModel::with(['vendor', 'subCategory', 'city']);

        if ($request->filled('placement')) {
            $query->where('placement', $request->placement);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('vendor', function ($v) use ($keyword) {
                      $v->where('name', 'LIKE', "%{$keyword}%")->orWhere('phone', 'LIKE', "%{$keyword}%");
                  });
            });
        }

        $promotions = $query->latest()->paginate(15)->withQueryString();

        $vendors = VendorModel::where('status', 'approved')->orderBy('name')->get();
        $subCategories = SubCategoryModel::where('status', 1)->orderBy('sub_category_name')->get();
        $cities = CityModel::where('status', 1)->orderBy('city_name')->get();

        $totalActiveAds = VendorPromotionModel::where('status', 1)->where('end_date', '>=', now()->toDateString())->count();
        $totalAdRevenue = VendorPromotionModel::sum('price') ?? 0;

        return view('vendorPromotions', compact('promotions', 'vendors', 'subCategories', 'cities', 'totalActiveAds', 'totalAdRevenue'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_id'    => 'required|exists:vendors,id',
            'placement'    => 'required|in:home_banner,category_top,city_featured',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'price'        => 'required|numeric|min:0',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = 'ad_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banner_images'), $filename);
            $imagePath = 'uploads/banner_images/' . $filename;
        }

        VendorPromotionModel::create([
            'vendor_id'        => $request->vendor_id,
            'sub_category_id'  => $request->sub_category_id,
            'city_id'          => $request->city_id,
            'title'            => $request->title,
            'banner_image'     => $imagePath,
            'placement'        => $request->placement,
            'coupon_code'      => $request->coupon_code ? strtoupper(trim($request->coupon_code)) : null,
            'discount_percent' => $request->discount_percent ?? 0,
            'discount_amount'  => $request->discount_amount ?? 0.00,
            'offer_badge'      => $request->offer_badge,
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
            'price'            => $request->price,
            'status'           => $request->status ?? 1,
        ]);

        return redirect()->back()->with('success', 'Vendor Ad / Promoted Listing created successfully.');
    }

    public function status($id)
    {
        $promo = VendorPromotionModel::findOrFail($id);
        $promo->status = ($promo->status == 1) ? 0 : 1;
        $promo->save();

        $msg = $promo->status == 1 ? 'Vendor Ad activated successfully.' : 'Vendor Ad paused/disabled.';
        return redirect()->back()->with('success', $msg);
    }

    public function destroy($id)
    {
        $promo = VendorPromotionModel::findOrFail($id);
        $promo->delete();

        return redirect()->back()->with('success', 'Vendor Ad deleted successfully.');
    }
}
