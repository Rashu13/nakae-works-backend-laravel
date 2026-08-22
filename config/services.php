<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'infrainfotech' => [
        'url'         => env('INFRAINFOTECH_SMS_URL', 'https://sms.infrainfotech.com/sms-panel/api/http/index.php'),
        'username'    => env('INFRAINFOTECH_SMS_USERNAME', 'Starnext'),
        'apikey'      => env('INFRAINFOTECH_SMS_APIKEY', 'EB98B-9C93C'),
        'sender'      => env('INFRAINFOTECH_SMS_SENDER', 'ROHIAL'),
        'template_id' => env('INFRAINFOTECH_SMS_TEMPLATE_ID', '1507165087189012738'),
        'route'       => env('INFRAINFOTECH_SMS_ROUTE', 'DND'),
    ],

];

