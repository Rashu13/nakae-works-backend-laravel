<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequestModel;
use App\Models\VendorModel;
use App\Models\RequestMessagesModel;
use App\Models\NotificationsModel;
use Illuminate\Http\Request;

class ServiceRequestsController extends Controller
{
    public function serviceRequests()
    {
        $serviceRequests = ServiceRequestModel::with(['user', 'vendor', 'category', 'subCategory'])->latest()->get();
        $vendors = VendorModel::with('city')->orderBy('name', 'ASC')->get();

        return view('serviceRequests', compact('serviceRequests', 'vendors'));
    }

    public function serviceRequestView($id)
    {
        $req = ServiceRequestModel::with([
            'user.state',
            'user.city',
            'vendor.state',
            'vendor.city',
            'category',
            'subCategory',
            'address',
            'requestImages',
            'messages.customer',
            'messages.vendor',
            'messages.admin'
        ])->findOrFail($id);

        $vendors = VendorModel::with('city')->orderBy('name', 'ASC')->get();

        return view('serviceView', compact('req', 'vendors'));
    }

    /**
     * Transfer / Reassign Service Request to another Vendor
     */
    public function reassignVendor(Request $request, $id)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'status'    => 'nullable|string',
            'reason'    => 'nullable|string|max:500',
        ]);

        $serviceReq = ServiceRequestModel::with(['vendor', 'user', 'subCategory'])->findOrFail($id);
        $oldVendor = $serviceReq->vendor;
        $oldVendorName = $oldVendor ? $oldVendor->name : 'Unassigned';

        $newVendor = VendorModel::findOrFail($request->vendor_id);

        // Update Service Request Vendor and Status
        $serviceReq->vendor_id = $newVendor->id;
        if ($request->filled('status')) {
            $serviceReq->status = $request->status;
        } else {
            $serviceReq->status = 'Assigned';
        }
        $serviceReq->save();

        $reasonText = $request->filled('reason') ? "Reason: " . $request->reason : "Transferred by Admin due to vendor availability / request update.";

        // 1. Add record to Communication / Chat history
        RequestMessagesModel::create([
            'request_id'  => $serviceReq->id,
            'sender_type' => 'admin',
            'sender_id'   => auth('admin')->id() ?? 1,
            'message'     => "🔄 Service Booking Transferred: Reassigned from '{$oldVendorName}' to '{$newVendor->name}'. {$reasonText}",
        ]);

        // 2. In-App Notification to New Vendor
        NotificationsModel::create([
            'user_type' => 'vendor',
            'user_id'   => $newVendor->id,
            'title'     => 'New Service Booking Assigned!',
            'message'   => "Admin has transferred/assigned service booking #{$serviceReq->request_code} to you. Preferred Slot: {$serviceReq->preferred_date} ({$serviceReq->preferred_time}).",
            'is_read'   => 0,
        ]);

        // 3. In-App Notification to Previous Vendor (if different)
        if ($oldVendor && $oldVendor->id != $newVendor->id) {
            NotificationsModel::create([
                'user_type' => 'vendor',
                'user_id'   => $oldVendor->id,
                'title'     => 'Service Booking Reassigned',
                'message'   => "Service booking #{$serviceReq->request_code} has been transferred to another partner by Admin.",
                'is_read'   => 0,
            ]);
        }

        // 4. In-App Notification to Customer
        if ($serviceReq->user_id) {
            NotificationsModel::create([
                'user_type' => 'customer',
                'user_id'   => $serviceReq->user_id,
                'title'     => 'Service Partner Updated',
                'message'   => "Service partner '{$newVendor->name}' is now assigned for your booking #{$serviceReq->request_code}.",
                'is_read'   => 0,
            ]);
        }

        // 5. Send FCM Push Notification to New Vendor device if token available
        $fcmToken = $newVendor->device_token ?? $newVendor->fcm_token;
        if ($fcmToken && class_exists(\App\Http\Controllers\BroadcastNotificationController::class)) {
            try {
                $serviceName = $serviceReq->subCategory ? $serviceReq->subCategory->sub_category_name : 'Service';
                \App\Http\Controllers\BroadcastNotificationController::sendFcmPushNotification(
                    [$fcmToken],
                    'New Service Booking Assigned',
                    "You have been assigned booking #{$serviceReq->request_code} ({$serviceName}).",
                    ['request_id' => $serviceReq->id, 'type' => 'booking_assigned']
                );
            } catch (\Exception $e) {
                // FCM failure should not break reassign flow
            }
        }

        return back()->with('success', "Service Request #{$serviceReq->request_code} successfully transferred to '{$newVendor->name}'!");
    }
}

