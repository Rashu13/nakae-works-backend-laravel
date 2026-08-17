<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequestModel;
use App\Models\NotificationsModel;

class BookingController extends Controller
{
    public function addBooking(Request $request)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->validate([
            'category_id'        => 'required|exists:categories,id',
            'sub_category_id'    => 'required|exists:sub_categories,id',
            'address_id'         => 'required|exists:user_addresses,id',
            'problem_description' => 'required|string',
            'preferred_date'     => 'required|date',
            'vendor_id'     => 'required',
            'preferred_time'     => 'required',
            'budget'             => 'nullable|numeric',
            'latitude'           => 'nullable',
            'longitude'          => 'nullable',
        ]);

        // Generate Request Code
        $lastId = ServiceRequestModel::max('id') + 1;
        $requestCode = 'REQ' . str_pad($lastId, 6, '0', STR_PAD_LEFT);

        // Auto-calculate budget from SubCategory pricing if not provided
        $subCategory = \App\Models\SubCategoryModel::find($request->sub_category_id);
        $calculatedBudget = $subCategory ? ($subCategory->base_price + $subCategory->visiting_fee + $subCategory->service_charge + $subCategory->delivery_charge) : 0;
        $finalBudget = ($request->has('budget') && $request->budget > 0) ? $request->budget : $calculatedBudget;

        $booking = ServiceRequestModel::create([
            'request_code'        => $requestCode,
            'user_id'             => $user->id,
            'vendor_id'           => $request->vendor_id,
            'category_id'         => $request->category_id,
            'sub_category_id'     => $request->sub_category_id,
            'address_id'          => $request->address_id,
            'problem_description' => $request->problem_description,
            'preferred_date'      => $request->preferred_date,
            'preferred_time'      => $request->preferred_time,
            'budget'              => $finalBudget,
            'latitude'            => $request->latitude,
            'longitude'           => $request->longitude,
            'status'              => 'pending',
        ]);

        // Customer Notification
        NotificationsModel::create([
            'user_type' => 'customer',
            'user_id'   => $user->id,
            'title'     => 'Booking Submitted',
            'message'   => 'Your booking (' . $booking->request_code . ') has been submitted successfully.',
            'is_read'   => 0,
        ]);

        // Vendor Notification
        NotificationsModel::create([
            'user_type' => 'vendor',
            'user_id'   => $booking->vendor_id,
            'title'     => 'New Booking',
            'message'   => 'You have received a new booking (' . $booking->request_code . '). Please review and respond.',
            'is_read'   => 0,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Service booked successfully.',
            'data' => $booking
        ], 201);
    }
    public function allBookings()
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $bookings = ServiceRequestModel::with([
            'category',
            'subCategory',
            'vendor',
            'address'
        ])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Booking list fetched successfully.',
            'total' => $bookings->count(),
            'data' => $bookings
        ], 200);
    }
    public function bookingDetails($id)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $booking = ServiceRequestModel::with([
            'category',
            'subCategory',
            'vendor',
            'address',
            'review',
        ])->where('user_id', $user->id)->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Booking details fetched successfully.',
            'data' => $booking
        ], 200);
    }

    public function cancelService(Request $request, $id)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $booking = ServiceRequestModel::where('user_id', $user->id)
            ->where('status', 'pending')
            ->findOrFail($id);

        $booking->status = 'cancelled';
        $booking->user_cancel_remark = $request->user_cancel_remark;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Service Canceled Successfully.',
            'data' => $booking
        ]);
    }
    public function allNotifications()
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $notifications = NotificationsModel::where('user_type', 'customer')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Notifications fetched successfully.',
            'total' => $notifications->count(),
            'data' => $notifications
        ], 200);
    }
    public function notificationView($id)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $notification = NotificationsModel::where('id', $id)
            ->where('user_type', 'customer')
            ->where('user_id', $user->id)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.'
            ], 404);
        }

        // Mark notification as read
        $notification->is_read = 1;
        $notification->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification viewed successfully.',
            'data' => $notification
        ], 200);
    }
}
