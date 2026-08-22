<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send OTP SMS using Infrainfotech HTTP SMS API Gateway.
     * 
     * API URL Format:
     * https://sms.infrainfotech.com/sms-panel/api/http/index.php?username=Starnext&apikey=EB98B-9C93C&apirequest=Text&sender=ROHIAL&mobile=MobileNumber&message={#var#} is your OTP, Please enter this code to confirm your Registration. : SMS Sent Via ROHAIL&route=DND&TemplateID=1507165087189012738&format=JSON
     * 
     * @param string $mobile Target 10-digit mobile number
     * @param string $otp 4 or 6 digit OTP string
     * @return array Response status and details
     */
    public static function sendOtp($mobile, $otp)
    {
        // Sanitize phone number (keep last 10 digits if 91 prefix is present)
        $cleanMobile = preg_replace('/[^0-9]/', '', $mobile);
        if (strlen($cleanMobile) > 10) {
            $cleanMobile = substr($cleanMobile, -10);
        }

        $baseUrl    = config('services.infrainfotech.url', 'https://sms.infrainfotech.com/sms-panel/api/http/index.php');
        $username   = config('services.infrainfotech.username', 'Starnext');
        $apiKey     = config('services.infrainfotech.apikey', 'EB98B-9C93C');
        $sender     = config('services.infrainfotech.sender', 'ROHIAL');
        $templateId = config('services.infrainfotech.template_id', '1507165087189012738');
        $route      = config('services.infrainfotech.route', 'DND');

        // Exact DLT template message as per provider registration
        $message = "{$otp} is your OTP, Please enter this code to confirm your Registration. : SMS Sent Via ROHAIL";

        try {
            $response = Http::get($baseUrl, [
                'username'   => $username,
                'apikey'     => $apiKey,
                'apirequest' => 'Text',
                'sender'     => $sender,
                'mobile'     => $cleanMobile,
                'message'    => $message,
                'route'      => $route,
                'TemplateID' => $templateId,
                'format'     => 'JSON',
            ]);

            Log::info("SMS Gateway Response for {$cleanMobile}: Status: " . $response->status() . " Body: " . $response->body());

            $decoded = $response->json();

            return [
                'success'     => $response->successful(),
                'status_code' => $response->status(),
                'mobile'      => $cleanMobile,
                'otp'         => $otp,
                'api_response'=> $decoded ?? $response->body(),
            ];
        } catch (\Exception $e) {
            Log::error("SMS Gateway Exception for {$cleanMobile}: " . $e->getMessage());

            return [
                'success' => false,
                'mobile'  => $cleanMobile,
                'otp'     => $otp,
                'message' => $e->getMessage(),
            ];
        }
    }
}
