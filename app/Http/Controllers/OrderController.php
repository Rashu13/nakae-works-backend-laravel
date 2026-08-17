<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequestModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    public function allCompleteRequests()
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
            ->where('status', 'completed')
            ->latest('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Completed requests fetched successfully.',
            'total' => $bookings->count(),
            'data' => $bookings
        ]);
    }


    public function allCompleteRequestsCount()
    {
        $vendor = auth('vendor')->user();

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $count = ServiceRequestModel::where('vendor_id', $vendor->id)
            ->where('status', 'completed')
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Completed requests count fetched successfully.',
            'count' => $count
        ]);
    }
    public function todayPendingRequests()
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
            ->where('status', 'pending')
            ->whereDate('preferred_date', Carbon::today())
            ->latest('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Today pending requests fetched successfully.',
            'total' => $bookings->count(),
            'data' => $bookings
        ]);
    }


    public function todayPendingRequestsCount()
    {
        $vendor = auth('vendor')->user();

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $count = ServiceRequestModel::where('vendor_id', $vendor->id)
            ->where('status', 'pending')
            ->whereDate('preferred_date', Carbon::today())
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Today pending requests count fetched successfully.',
            'count' => $count
        ]);
    }
    public function todayAcceptedRequests()
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
            ->where('status', 'accepted')
            ->whereDate('preferred_date', Carbon::today())
            ->latest('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Today accepted requests fetched successfully.',
            'total' => $bookings->count(),
            'data' => $bookings
        ]);
    }

    public function todayAcceptedRequestsCount()
    {
        $vendor = auth('vendor')->user();

        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $count = ServiceRequestModel::where('vendor_id', $vendor->id)
            ->where('status', 'accepted')
            ->whereDate('preferred_date', Carbon::today())
            ->count();

        return response()->json([
            'success' => true,
            'message' => 'Today accepted requests count fetched successfully.',
            'count' => $count
        ]);
    }
}
