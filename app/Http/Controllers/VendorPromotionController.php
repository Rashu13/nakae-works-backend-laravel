<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorPromotionModel;
use App\Models\VendorModel;
use App\Models\SubCategoryModel;
use App\Models\CityModel;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class VendorPromotionController extends Controller
{
    private function ensureColumnsExist()
    {
        try {
            if (Schema::hasTable('vendor_promotions')) {
                Schema::table('vendor_promotions', function (Blueprint $table) {
                    if (!Schema::hasColumn('vendor_promotions', 'coupon_code')) {
                        $table->string('coupon_code', 50)->nullable()->after('placement');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'discount_type')) {
                        $table->string('discount_type', 20)->default('percent')->after('coupon_code');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'discount_percent')) {
                        $table->integer('discount_percent')->nullable()->default(0)->after('discount_type');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'discount_amount')) {
                        $table->decimal('discount_amount', 10, 2)->nullable()->default(0.00)->after('discount_percent');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'original_price')) {
                        $table->decimal('original_price', 10, 2)->nullable()->default(0.00)->after('discount_amount');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'offer_price')) {
                        $table->decimal('offer_price', 10, 2)->nullable()->default(0.00)->after('original_price');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'offer_badge')) {
                        $table->string('offer_badge', 100)->nullable()->after('offer_price');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'max_uses_per_user')) {
                        $table->integer('max_uses_per_user')->default(1)->after('offer_badge');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'total_usage_limit')) {
                        $table->integer('total_usage_limit')->nullable()->after('max_uses_per_user');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'min_order_amount')) {
                        $table->decimal('min_order_amount', 10, 2)->default(0.00)->after('total_usage_limit');
                    }
                    if (!Schema::hasColumn('vendor_promotions', 'terms_note')) {
                        $table->text('terms_note')->nullable()->after('min_order_amount');
                    }
                });
            }
        } catch (\Exception $e) {
            // Log or ignore if DDL permissions are restricted
        }
    }

    public function index(Request $request)
    {
        $this->ensureColumnsExist();

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

        $vendors = VendorModel::with(['services.subCategory'])->where('status', 'approved')->orderBy('name')->get();
        $subCategories = SubCategoryModel::where('status', 1)->orderBy('sub_category_name')->get();
        $cities = CityModel::where('status', 1)->orderBy('city_name')->get();

        $totalActiveAds = VendorPromotionModel::where('status', 1)->where('end_date', '>=', now()->toDateString())->count();
        $totalAdRevenue = VendorPromotionModel::sum('price') ?? 0;

        return view('vendorPromotions', compact('promotions', 'vendors', 'subCategories', 'cities', 'totalActiveAds', 'totalAdRevenue'));
    }

    public function store(Request $request)
    {
        $this->ensureColumnsExist();

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

        $insertData = [
            'vendor_id'    => $request->vendor_id,
            'sub_category_id' => $request->sub_category_id,
            'city_id'      => $request->city_id,
            'title'        => $request->title,
            'banner_image' => $imagePath,
            'placement'    => $request->placement,
            'start_date'   => $request->start_date,
            'end_date'     => $request->end_date,
            'price'        => $request->price,
            'status'       => $request->status ?? 1,
        ];

        // Safely add extended offer fields only if present in table
        $extendedFields = [
            'coupon_code'       => $request->coupon_code ? strtoupper(trim($request->coupon_code)) : null,
            'discount_type'     => $request->discount_type ?? 'percent',
            'discount_percent'  => $request->discount_percent ?? 0,
            'discount_amount'   => $request->discount_amount ?? 0.00,
            'original_price'    => $request->original_price ?? 0.00,
            'offer_price'       => $request->offer_price ?? 0.00,
            'offer_badge'       => $request->offer_badge,
            'max_uses_per_user' => $request->max_uses_per_user ?? 1,
            'total_usage_limit' => $request->total_usage_limit,
            'min_order_amount'  => $request->min_order_amount ?? 0.00,
            'terms_note'        => $request->terms_note,
        ];

        foreach ($extendedFields as $key => $val) {
            if (Schema::hasColumn('vendor_promotions', $key)) {
                $insertData[$key] = $val;
            }
        }

        VendorPromotionModel::create($insertData);

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
