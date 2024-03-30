<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ClaimController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OurFeatureController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PendingListingController;
use App\Http\Controllers\Admin\ListingScheduleController;
use App\Http\Controllers\Admin\ListingImageGalleryController;
use App\Http\Controllers\Admin\ListingVideoGalleryController;

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('guest');
Route::get('/admin/forgot-password', [AdminAuthController::class, 'PasswordRequest'])->name('admin.password.request')->middleware('guest');


Route::group([
    'middleware' => ['auth', 'user.type:admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile-password', [ProfileController::class, 'passwordUpdate'])->name('profile-password.update');

    /** Hero Routes */
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');

    /** Category Routes */
    Route::resource('/category', CategoryController::class);

    /** Location Routes */
    Route::resource('/location', LocationController::class);

    /** Amenity Route */
    Route::resource('/amenity', AmenityController::class);

    /** Listing Routes  */
    Route::resource('/listing', ListingController::class);

    /** Pending Listing Routes  */
    Route::get('/pending-listing', [PendingListingController::class, 'index'])->name('pending-listing.index');
    Route::post('/pending-listing', [PendingListingController::class, 'update'])->name('pending-listing.update');

    /** Listing Image Galllery Routes  */
    Route::resource('/listing-image-gallery', ListingImageGalleryController::class);

    /** Listing Video Galllery Routes  */
    Route::resource('/listing-video-gallery', ListingVideoGalleryController::class);

    /** Listing Schedule Routes  */
    Route::get('/listing-schedule/{listing_id}', [ListingScheduleController::class, 'index'])->name('listing-schedule.index');
    Route::get('/listing-schedule/{listing_id}/create', [ListingScheduleController::class, 'create'])->name('listing-schedule.create');
    Route::post('/listing-schedule/{listing_id}', [ListingScheduleController::class, 'store'])->name('listing-schedule.store');
    Route::get('/listing-schedule/{id}/edit', [ListingScheduleController::class, 'edit'])->name('listing-schedule.edit');
    Route::put('/listing-schedule/{id}', [ListingScheduleController::class, 'update'])->name('listing-schedule.update');
    Route::delete('/listing-schedule/{id}', [ListingScheduleController::class, 'destroy'])->name('listing-schedule.destroy');

    /** Listing Review Routes  */
    Route::get('/listing-review', [ReviewController::class, 'index'])->name('listing-review.index');
    Route::get('/listing-review/{id}', [ReviewController::class, 'updateStatus'])->name('listing-review.update');
    Route::delete('/listing-review/{id}', [ReviewController::class, 'destroy'])->name('listing-review.destroy');

    /** Listing Claim Routes  */
    Route::get('/listing-claims', [ClaimController::class, 'index'])->name('listing-claims.index');
    Route::delete('/listing-claims/{id}', [ClaimController::class, 'destroy'])->name('listing-claims.destroy');

    /** Package Routes  */
    Route::resource('/package', PackageController::class);


    /** Order Routes  */
    Route::resource('/orders', OrderController::class);

    /** Messages Routes */
    Route::get('/messages', [ChatController::class, 'index'])->name('messages.index');
    Route::get('/get-messages', [ChatController::class, 'getMessages'])->name('get-messages');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');

    /** Our Faeture Routes */
    Route::resource('/our-features', OurFeatureController::class);

    /** Testimonial Routes */
    Route::resource('/testimonial', TestimonialController::class);

    /** Counter Routes */
    Route::resource('/counter', CounterController::class);

    /** Blog Category Route */
    Route::resource('/blog-category', BlogCategoryController::class);

    /** Blog Route */
    Route::resource('/blog', BlogController::class);
    Route::get('blog-comment', [BlogCommentController::class, 'index'])->name('blog-comment.index');
    Route::get('comment-status', [BlogCommentController::class, 'updateCommentStatus'])->name('comment-status.update');
    Route::delete('blog-comment/{id}', [BlogCommentController::class, 'destroy'])->name('blog-comment.destroy');

    /** Settings Routes  */
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/general-settings', [SettingController::class, 'updateGeneralSetting'])->name('general-settings.update');
    //pusher settings
    Route::post('/pusher-settings', [SettingController::class, 'updatePusherSetting'])->name('pusher-settings.update');


    /** Payment Settings Routes  */
    Route::get('/payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::post('/paypal-settings', [PaymentSettingController::class, 'paypalSetting'])->name('paypal-settings.update');
    Route::post('/stripe-settings', [PaymentSettingController::class, 'stripeSetting'])->name('stripe-settings.update');
    Route::post('/razorpay-settings', [PaymentSettingController::class, 'razorpaySetting'])->name('razorpay-settings.update');
});
