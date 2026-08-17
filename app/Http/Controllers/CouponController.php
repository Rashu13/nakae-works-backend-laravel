<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CouponModel;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = CouponModel::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $keyword = strtoupper(trim($request->search));
            $query->where('coupon_code', 'LIKE', "%{$keyword}%");
        }

        $coupons = $query->latest()->paginate(15)->withQueryString();

        $activeCouponsCount = CouponModel::where('status', 1)->where(function($q) {
            $q->whereNull('expiry_date')->orWhere('expiry_date', '>=', now()->toDateString());
        })->count();

        $totalUsedCount = CouponModel::sum('used_count') ?? 0;

        return view('couponsList', compact('coupons', 'activeCouponsCount', 'totalUsedCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code'        => 'required|string|unique:coupons,coupon_code|max:30',
            'discount_type'      => 'required|in:percentage,fixed',
            'discount_value'     => 'required|numeric|min:0.01',
            'max_discount_amount'=> 'nullable|numeric|min:0',
            'min_booking_amount' => 'required|numeric|min:0',
            'total_usage_limit'  => 'required|integer|min:1',
            'start_date'         => 'nullable|date',
            'expiry_date'        => 'nullable|date|after_or_equal:start_date',
        ]);

        CouponModel::create([
            'coupon_code'         => strtoupper(trim($request->coupon_code)),
            'discount_type'       => $request->discount_type,
            'discount_value'      => $request->discount_value,
            'max_discount_amount' => $request->max_discount_amount,
            'min_booking_amount'  => $request->min_booking_amount ?? 0,
            'total_usage_limit'   => $request->total_usage_limit ?? 100,
            'start_date'          => $request->start_date,
            'expiry_date'         => $request->expiry_date,
            'status'              => $request->status ?? 1,
        ]);

        return redirect()->back()->with('success', 'Promo Coupon created successfully.');
    }

    public function status($id)
    {
        $coupon = CouponModel::findOrFail($id);
        $coupon->status = ($coupon->status == 1) ? 0 : 1;
        $coupon->save();

        $msg = $coupon->status == 1 ? 'Coupon activated successfully.' : 'Coupon deactivated.';
        return redirect()->back()->with('success', $msg);
    }

    public function destroy($id)
    {
        $coupon = CouponModel::findOrFail($id);
        $coupon->delete();

        return redirect()->back()->with('success', 'Coupon deleted successfully.');
    }

    // API: Available Coupons List
    public function apiAvailableCoupons()
    {
        $today = now()->toDateString();
        $coupons = CouponModel::where('status', 1)
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('expiry_date')->orWhere('expiry_date', '>=', $today);
            })
            ->whereColumn('used_count', '<', 'total_usage_limit')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Available Coupons',
            'data'    => $coupons
        ], 200);
    }

    // API: Apply Coupon Validation
    public function apiApplyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code'    => 'required|string',
            'booking_amount' => 'required|numeric|min:0',
        ]);

        $code = strtoupper(trim($request->coupon_code));
        $bookingAmount = $request->booking_amount;
        $today = now()->toDateString();

        $coupon = CouponModel::where('coupon_code', $code)
            ->where('status', 1)
            ->first();

        if (!$coupon) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid or expired promo code.'
            ], 404);
        }

        if ($coupon->start_date && $today < $coupon->start_date) {
            return response()->json([
                'status'  => false,
                'message' => 'Promo code is not active yet.'
            ], 400);
        }

        if ($coupon->expiry_date && $today > $coupon->expiry_date) {
            return response()->json([
                'status'  => false,
                'message' => 'Promo code has expired.'
            ], 400);
        }

        if ($coupon->used_count >= $coupon->total_usage_limit) {
            return response()->json([
                'status'  => false,
                'message' => 'Promo code usage limit reached.'
            ], 400);
        }

        if ($bookingAmount < $coupon->min_booking_amount) {
            return response()->json([
                'status'  => false,
                'message' => 'Minimum booking amount to use this coupon is ₹' . number_format($coupon->min_booking_amount, 2)
            ], 400);
        }

        // Calculate discount
        if ($coupon->discount_type === 'percentage') {
            $discount = ($bookingAmount * $coupon->discount_value) / 100;
            if ($coupon->max_discount_amount && $discount > $coupon->max_discount_amount) {
                $discount = $coupon->max_discount_amount;
            }
        } else {
            $discount = $coupon->discount_value;
        }

        if ($discount > $bookingAmount) {
            $discount = $bookingAmount;
        }

        $finalAmount = $bookingAmount - $discount;

        return response()->json([
            'status'  => true,
            'message' => 'Coupon applied successfully!',
            'data'    => [
                'coupon_code'     => $coupon->coupon_code,
                'original_amount' => number_format((float)$bookingAmount, 2, '.', ''),
                'discount_amount' => number_format((float)$discount, 2, '.', ''),
                'final_amount'    => number_format((float)$finalAmount, 2, '.', ''),
            ]
        ], 200);
    }
}
