<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BroadcastNotificationModel;
use App\Models\NotificationsModel;
use App\Models\User;
use App\Models\VendorModel;
use App\Models\CityModel;

class BroadcastNotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = BroadcastNotificationModel::with('city');

        if ($request->filled('audience')) {
            $query->where('target_audience', $request->audience);
        }

        $broadcasts = $query->latest()->paginate(15)->withQueryString();
        $cities = CityModel::where('status', 1)->orderBy('city_name')->get();

        $totalBroadcastsSent = BroadcastNotificationModel::count();
        $totalNotificationsDelivered = BroadcastNotificationModel::sum('sent_count') ?? 0;

        return view('broadcastNotifications', compact('broadcasts', 'cities', 'totalBroadcastsSent', 'totalNotificationsDelivered'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'target_audience' => 'required|in:all_customers,all_vendors,specific_city',
            'title'           => 'required|string|max:255',
            'message'         => 'required|string',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'broadcast_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/notifications'), $filename);
            $imagePath = 'uploads/notifications/' . $filename;
        }

        $sentCount = 0;
        $targetAudience = $request->target_audience;

        if ($targetAudience === 'all_customers') {
            $users = User::pluck('id');
            foreach ($users as $userId) {
                NotificationsModel::create([
                    'user_type' => 'customer',
                    'user_id'   => $userId,
                    'title'     => $request->title,
                    'message'   => $request->message,
                    'is_read'   => 0,
                ]);
                $sentCount++;
            }
        } elseif ($targetAudience === 'all_vendors') {
            $vendors = VendorModel::pluck('id');
            foreach ($vendors as $vendorId) {
                NotificationsModel::create([
                    'user_type' => 'vendor',
                    'user_id'   => $vendorId,
                    'title'     => $request->title,
                    'message'   => $request->message,
                    'is_read'   => 0,
                ]);
                $sentCount++;
            }
        } elseif ($targetAudience === 'specific_city' && $request->city_id) {
            $vendors = VendorModel::where('city_id', $request->city_id)->pluck('id');
            foreach ($vendors as $vendorId) {
                NotificationsModel::create([
                    'user_type' => 'vendor',
                    'user_id'   => $vendorId,
                    'title'     => $request->title,
                    'message'   => $request->message,
                    'is_read'   => 0,
                ]);
                $sentCount++;
            }

            $users = User::pluck('id'); // Customer city match fallback
            foreach ($users as $userId) {
                NotificationsModel::create([
                    'user_type' => 'customer',
                    'user_id'   => $userId,
                    'title'     => $request->title,
                    'message'   => $request->message,
                    'is_read'   => 0,
                ]);
                $sentCount++;
            }
        }

        $tokens = [];
        if ($targetAudience === 'all_customers') {
            $tokens = User::whereNotNull('device_token')->pluck('device_token')->toArray();
        } elseif ($targetAudience === 'all_vendors') {
            $tokens = VendorModel::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        }

        if (!empty($tokens)) {
            self::sendFcmPushNotification($tokens, $request->title, $request->message);
        }

        BroadcastNotificationModel::create([
            'target_audience' => $targetAudience,
            'city_id'         => $request->city_id,
            'title'           => $request->title,
            'message'         => $request->message,
            'image'           => $imagePath,
            'sent_count'      => $sentCount,
        ]);

        return redirect()->back()->with('success', 'Push Broadcast Notification sent successfully to ' . number_format($sentCount) . ' users/vendors!');
    }

    public static function sendFcmPushNotification($deviceTokens, $title, $message, $dataPayload = [])
    {
        $jsonPath = \App\Models\ContactDeatilModel::value('fcm_json_path');
        if ($jsonPath && file_exists(base_path($jsonPath))) {
            return self::sendFcmV1Notification(base_path($jsonPath), $deviceTokens, $title, $message, $dataPayload);
        }

        $serverKey = env('FCM_SERVER_KEY') 
                     ?? \App\Models\ContactDeatilModel::value('fcm_server_key') 
                     ?? 'AAAAmc-zHqc:APA91bEXeI3ojK38qRtxkeKnFu7JMOxRBDCFg4umR1IYJRAh75dQ6fZx_WvB8Wlng-p0jjf_rLXuXU74jBTY5RiLpYY9EF4xRdoW2Ou7shKB_mI2oehA0RRbVp960ZCxwN1HtjACyujC';

        if (empty($serverKey) || empty($deviceTokens)) {
            return false;
        }

        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = [
            'registration_ids' => is_array($deviceTokens) ? array_values(array_filter($deviceTokens)) : [$deviceTokens],
            'notification' => [
                'title' => $title,
                'body'  => $message,
                'sound' => 'default',
                'badge' => 1,
            ],
            'data' => $dataPayload
        ];

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public static function sendFcmV1Notification($jsonFilePath, $deviceTokens, $title, $message, $dataPayload = [])
    {
        $serviceAccount = json_decode(file_get_contents($jsonFilePath), true);
        if (!$serviceAccount || !isset($serviceAccount['project_id'])) {
            return false;
        }

        $accessToken = self::getGoogleAccessTokenFromServiceAccount($serviceAccount);
        if (!$accessToken) {
            return false;
        }

        $projectId = $serviceAccount['project_id'];
        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $tokens = is_array($deviceTokens) ? array_values(array_filter($deviceTokens)) : [$deviceTokens];
        $results = [];

        foreach ($tokens as $token) {
            $payload = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body'  => $message,
                    ],
                    'data' => array_map('strval', $dataPayload)
                ]
            ];

            $headers = [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json; UTF-8'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

            $res = curl_exec($ch);
            curl_close($ch);
            $results[] = $res;
        }

        return $results;
    }

    private static function getGoogleAccessTokenFromServiceAccount($serviceAccount)
    {
        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $now = time();
        $payload = json_encode([
            'iss'   => $serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now
        ]);

        $base64UrlHeader  = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signatureInput = $base64UrlHeader . "." . $base64UrlPayload;
        $signature = '';

        openssl_sign($signatureInput, $signature, $serviceAccount['private_key'], 'SHA256');
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $jwt = $signatureInput . "." . $base64UrlSignature;

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt
        ]));

        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response, true);
        return $json['access_token'] ?? null;
    }

    public function destroy($id)
    {
        $broadcast = BroadcastNotificationModel::findOrFail($id);
        $broadcast->delete();

        return redirect()->back()->with('success', 'Broadcast log deleted successfully.');
    }
}
