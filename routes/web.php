<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ServiceRequestsController;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AdminController::class, 'login_page'])->name('adm.login.page');
Route::get('/privacy-policy', [AdminController::class, 'privacy_policy']);
Route::get('/terms-and-conditions', [AdminController::class, 'terms']);
Route::get('/about', [AdminController::class, 'about']);
Route::get('/account-deletion-request', [AdminController::class, 'account_deletion']);
Route::get('/delete-account', [AdminController::class, 'account_deletion']);
Route::post('/account-deletion-request', [AdminController::class, 'submit_account_deletion']);
Route::post('/admin/login', [AdminController::class, 'login'])->name('adm.login');


Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');

    Route::get('/add-state', [CityController::class, 'index'])->name('state.index');
    Route::get('/state-home-change/{id}', [CityController::class, 'state_home'])->name('state.home');
    Route::get('/city-home-change/{id}', [CityController::class, 'city_home'])->name('city.home');
    Route::get('/add-city', [CityController::class, 'cityIndex'])->name('city.index');

    Route::post('/state/store', [CityController::class, 'storeState'])->name('state.store');
    Route::get('/state/edit/{id}', [CityController::class, 'editState'])->name('state.edit');
    Route::post('/state/update/{id}', [CityController::class, 'updateState'])->name('state.update');
    Route::delete('/state/delete/{id}', [CityController::class, 'deleteState'])->name('state.delete');
    Route::post('/get-state-data', [CityController::class, 'getStateData'])->name('get.state.data');

    Route::post('/city/store', [CityController::class, 'storeCity'])->name('city.store');
    Route::get('/city/edit/{id}', [CityController::class, 'editCity'])->name('city.edit');
    Route::post('/city/update/{id}', [CityController::class, 'updateCity'])->name('city.update');
    Route::delete('/city/delete/{id}', [CityController::class, 'deleteCity'])->name('city.delete');
    Route::post('/get-city-data/', [CityController::class, 'getCityData'])->name('city.get.data');
    Route::get('/city-by-state/{state_id}', [CityController::class, 'cityByState'])->name('city.by.state');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'storeCategory'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');

    Route::get('/sub-category-list', [CategoryController::class, 'subCateIndex'])->name('subCategory.index');
    Route::post('/subcategory/store', [CategoryController::class, 'storeSubCategory'])->name('subcategory.store');
    Route::get('/subcategory/edit/{id}', [CategoryController::class, 'editSubCategory'])->name('subcategory.edit');
    Route::post('/subcategory/update/{id}', [CategoryController::class, 'updateSubCategory'])->name('subcategory.update');
    Route::delete('/subcategory/delete/{id}', [CategoryController::class, 'deleteSubCategory'])->name('subcategory.delete');


    Route::get('/vendors-list', [VendorController::class, 'vendorsList'])->name('vendor.index');
    Route::get('/add-vendors', [VendorController::class, 'vendorsAdd'])->name('add.vendors');
    Route::get('/vendor-view/{id}', [VendorController::class, 'vendorView'])->name('vendor.view');
    Route::post('/add-vendors-post', [VendorController::class, 'vendorsAddPost'])->name('vendor.store');
    Route::get('/verify-vendor-status/{id}', [VendorController::class, 'vendorVerifyState'])->name('vendor.verify.status');
    Route::get('/change-vendor-profile-status/{id}', [VendorController::class, 'profile_complete_status'])->name('vendor.complete.profile.status');

    Route::get('/edit-vendor/{id}', [VendorController::class, 'editVendor'])->name('edit.vendor');
    Route::put('/edit-vendor-post/{id}', [VendorController::class, 'editVendorPost'])->name('vendor.update');


    Route::get('/user-list', [AdminUserController::class, 'userList'])->name('user.list');
    Route::get('/user-view/{id}', [AdminUserController::class, 'userView'])->name('user.view');
    Route::get('/user-edit/{id}', [AdminUserController::class, 'userEditPage'])->name('user.edit.page');
    Route::put('/user-update-post/{id}', [AdminUserController::class, 'userEditPost'])->name('user.update');

    Route::get('/service-requests', [ServiceRequestsController::class, 'serviceRequests'])->name('service.requests');
    Route::get('/service-request-view/{id}', [ServiceRequestsController::class, 'serviceRequestView'])->name('service.requests.view');


    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    Route::post('/banner/add', [BannerController::class, 'addBannerPost'])->name('banner.add');
    Route::delete('/banner/delete/{id}', [BannerController::class, 'deleteBanner'])->name('banner.delete');
    Route::get('/banner/status/{id}', [BannerController::class, 'changeStatus'])->name('banner.status');

    Route::get('/contact-details', [BannerController::class, 'contactDetails'])->name('contact.details');
    Route::post('/edit-contact-details', [BannerController::class, 'editContactDetails'])->name('edit.contact.details');

    Route::get('/reviews', [App\Http\Controllers\ReviewController::class, 'adminReviewsList'])->name('reviews.index');
    Route::get('/review/status/{id}', [App\Http\Controllers\ReviewController::class, 'adminToggleReviewStatus'])->name('review.status');
    Route::delete('/review/delete/{id}', [App\Http\Controllers\ReviewController::class, 'adminDeleteReview'])->name('review.delete');

    Route::get('/vendor-promotions', [App\Http\Controllers\VendorPromotionController::class, 'index'])->name('vendor.promotions.index');
    Route::post('/vendor-promotions/store', [App\Http\Controllers\VendorPromotionController::class, 'store'])->name('vendor.promotions.store');
    Route::get('/vendor-promotions/status/{id}', [App\Http\Controllers\VendorPromotionController::class, 'status'])->name('vendor.promotions.status');
    Route::delete('/vendor-promotions/delete/{id}', [App\Http\Controllers\VendorPromotionController::class, 'destroy'])->name('vendor.promotions.delete');

    Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('coupons.index');
    Route::post('/coupons/store', [App\Http\Controllers\CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/status/{id}', [App\Http\Controllers\CouponController::class, 'status'])->name('coupons.status');
    Route::delete('/coupons/delete/{id}', [App\Http\Controllers\CouponController::class, 'destroy'])->name('coupons.delete');

    Route::get('/broadcast-notifications', [App\Http\Controllers\BroadcastNotificationController::class, 'index'])->name('broadcast.index');
    Route::post('/broadcast-notifications/send', [App\Http\Controllers\BroadcastNotificationController::class, 'sendBroadcast'])->name('broadcast.send');

    Route::get('/deletion-requests', [AdminController::class, 'adminDeletionRequestsList'])->name('deletion.requests.index');
    Route::delete('/deletion-requests/delete/{id}', [AdminController::class, 'adminDeleteDeletionRequest'])->name('deletion.requests.delete');
    Route::delete('/broadcast-notifications/delete/{id}', [App\Http\Controllers\BroadcastNotificationController::class, 'destroy'])->name('broadcast.delete');
});

Route::prefix('api')->name('api.')->group(function () {

    Route::get('/available-coupons', [App\Http\Controllers\CouponController::class, 'apiAvailableCoupons'])->name('coupons.available');
    Route::post('/apply-coupon', [App\Http\Controllers\CouponController::class, 'apiApplyCoupon'])->name('coupons.apply');

    Route::get('/category-list', [APIController::class, 'categoriesList'])->name('categories.list');
    Route::get('/sub-category-list', [APIController::class, 'subcategoriesList'])->name('subCategories.list');
    Route::get('/subcategory-list-by-categroy/{id}', [APIController::class, 'subcategoriesbyCate'])->name('subCategories.list.category');
    Route::get('/vendors-by-city/{cityId}', [APIController::class, 'vendorsByCity'])->name('vendors.list.by.city');
    Route::get('/vendors-by-city-subcategroy/{cityId}/{subCategroyId}', [APIController::class, 'vendorsByCitySubcategory'])->name('vendors.list.by.city.subcategory');
    Route::get('/all-banners', [APIController::class, 'allBanners'])->name('all.banners');
    Route::get('/promoted-ads', [APIController::class, 'promotedAds'])->name('promoted.ads');
    Route::get('/search-category', [APIController::class, 'searchCategories']);

    Route::get('/state-list', [APIController::class, 'statesList'])->name('state.list');
    Route::get('/city-list/{state_id}', [APIController::class, 'citiesList'])->name('city.list');
    // Route::get('/all-master-states', [AddressController::class, 'allMasterStates']);
    // Route::get('/all-master-city/{state_id}', [AddressController::class, 'allMasterCities']);
    Route::get('/api-list', [APIController::class, 'apiListFile'])->name('api.list');
    Route::get('/api-docs', [APIController::class, 'apiDocumentationPage'])->name('api.docs');
    Route::get('/app-version', [APIController::class, 'appVersion'])->name('app.version');
    Route::get('/contact-deatils', [APIController::class, 'contactDetails']);
});

Route::get('/api-docs', [APIController::class, 'apiDocumentationPage']);
Route::get('/api/docs', [APIController::class, 'apiDocumentationPage']);


Route::get('/optimize', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Caches cleared!";
});
