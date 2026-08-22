<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/login-get', [UserController::class, 'login_page'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/register', [UserController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Customer OTP Routes
|--------------------------------------------------------------------------
*/
Route::post('/send-otp', [OtpController::class, 'sendOtp']);
Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);
Route::post('/login-with-otp', [OtpController::class, 'loginWithOtp']);
Route::post('/register-with-otp', [OtpController::class, 'registerWithOtp']);


Route::middleware('auth:api')->group(function () {

    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/update-profile', [UserController::class, 'profileUpdate']);
    Route::get('/all-address', [AddressController::class, 'allAddresses']);

    Route::post('/add-address', [AddressController::class, 'addAddress']);
    Route::put('/update-address/{id}', [AddressController::class, 'updateAddress']);
    Route::delete('/delete-address/{id}', [AddressController::class, 'deleteAddress']);
    Route::post('/book-service', [BookingController::class, 'addBooking']);
    Route::get('/my-bookings', [BookingController::class, 'allBookings']);
    Route::get('/booking-details/{id}', [BookingController::class, 'bookingDetails']);
    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancelService']);
    Route::get('/all-notifications', [BookingController::class, 'allNotifications']);
    Route::get('/notification-view/{id}', [BookingController::class, 'notificationView']);


    Route::post('/add-review/{id}', [ReviewController::class, 'add_review']);
    Route::post('/edit-review/{id}', [ReviewController::class, 'edit_review']);
    Route::get('/review-details/{id}', [ReviewController::class, 'review_details']);
    Route::get('/my-reviews', [ReviewController::class, 'my_reviews']);
    Route::get('/delete-review/{id}', [ReviewController::class, 'delete_review']);

    Route::post('/update-device-token', [UserController::class, 'updateDeviceToken']);
    Route::delete('/delete-account', [UserController::class, 'deleteAccount']);
    Route::post('/delete-account', [UserController::class, 'deleteAccount']);
});





Route::prefix('vendor')->group(function () {

    Route::post('/login', [App\Http\Controllers\API\VendorController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\API\VendorController::class, 'register']);
    Route::post('/send-otp', [OtpController::class, 'sendVendorOtp']);
    Route::post('/verify-otp', [OtpController::class, 'verifyVendorOtp']);
    Route::post('/login-with-otp', [OtpController::class, 'loginVendorWithOtp']);
    Route::post('/register-with-otp', [OtpController::class, 'registerVendorWithOtp']);
    Route::get('/reviews-by-subcategory/{subCategory}/{vendorID}', [App\Http\Controllers\API\VendorController::class, 'reviewsBySubCatgory']);
    Route::get('/reviews-by-vendor/{vendorID}', [App\Http\Controllers\API\VendorController::class, 'reviewsByVendor']);
    Route::get('/reviews-by-vendor-avg/{vendorID}', [App\Http\Controllers\API\VendorController::class, 'reviewsByAvg']);


    Route::middleware('auth:vendor')->group(function () {

        Route::post('/complete-profile', [App\Http\Controllers\API\VendorController::class, 'completeProfile']);
        Route::post('/edit-service', [App\Http\Controllers\API\VendorController::class, 'editAddedService']);
        Route::post('/add-service', [App\Http\Controllers\API\VendorController::class, 'addService']);
        Route::get('/profile', [App\Http\Controllers\API\VendorController::class, 'profile']);
        Route::post('/logout', [App\Http\Controllers\API\VendorController::class, 'logout']);
        Route::get('/services', [App\Http\Controllers\API\VendorController::class, 'getServices']);
        Route::post('/update-profile', [App\Http\Controllers\API\VendorController::class, 'updateProfile']);
        Route::get('/all-notifications', [App\Http\Controllers\API\VendorController::class, 'allNotifications']);
        Route::get('/notification-view/{id}', [App\Http\Controllers\API\VendorController::class, 'notificationView']);
        Route::get('/booking-requests', [App\Http\Controllers\API\VendorController::class, 'bookingRequests']);
        Route::get('/booking-details/{id}', [App\Http\Controllers\API\VendorController::class, 'bookingDetails']);
        Route::post('/accept-booking/{id}', [App\Http\Controllers\API\VendorController::class, 'acceptBooking']);
        Route::post('/reject-booking/{id}', [App\Http\Controllers\API\VendorController::class, 'rejectBooking']);
        Route::post('/on-the-way/{id}', [App\Http\Controllers\API\VendorController::class, 'onTheWay']);
        Route::post('/start-service/{id}', [App\Http\Controllers\API\VendorController::class, 'startService']);
        Route::post('/complete-service/{id}', [App\Http\Controllers\API\VendorController::class, 'completeService']);

        Route::get('/review-list', [ReviewController::class, 'review_list_vendor']);
        Route::get('/review-details/{id}', [ReviewController::class, 'review_details_vendor']);

        Route::post('/update-availability', [App\Http\Controllers\API\VendorController::class, 'updateAvailability']);
        Route::delete('/delete-account', [App\Http\Controllers\API\VendorController::class, 'deleteAccount']);
        Route::post('/delete-account', [App\Http\Controllers\API\VendorController::class, 'deleteAccount']);


        // Completed Requests
        Route::get('/all-complete-requests', [OrderController::class, 'allCompleteRequests']);
        Route::get('/all-complete-requests-count', [OrderController::class, 'allCompleteRequestsCount']);

        // Today Pending Requests
        Route::get('/today-pending-requests', [OrderController::class, 'todayPendingRequests']);
        Route::get('/today-pending-requests-count', [OrderController::class, 'todayPendingRequestsCount']);

        // Today Accepted Requests
        Route::get('/today-accepted-requests', [OrderController::class, 'todayAcceptedRequests']);
        Route::get('/today-accepted-requests-count', [OrderController::class, 'todayAcceptedRequestsCount']);

        Route::post('/update-device-token', [App\Http\Controllers\API\VendorController::class, 'updateDeviceToken']);
        Route::post('/create-promotion', [App\Http\Controllers\API\VendorController::class, 'createPromotion']);
    });

});
