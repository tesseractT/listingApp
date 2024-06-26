<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AgentListingController;
use App\Http\Controllers\Frontend\AgentListingImageGalleryController;
use App\Http\Controllers\Frontend\AgentListingVideoGalleryController;
use App\Http\Controllers\Frontend\AgentListingScheduleController;
use App\Http\Controllers\Frontend\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ReviewController;

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

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('listing', [FrontendController::class, 'listings'])->name('listings');
Route::get('listing-modal/{id}', [FrontendController::class, 'listingModal'])->name('listing-modal');
Route::get('listing/{slug}', [FrontendController::class, 'showListing'])->name('listing.show');
Route::get('packages', [FrontendController::class, 'showPackages'])->name('packages');
Route::get('checkout/{id}', [FrontendController::class, 'checkout'])->name('checkout.index');

/** Review Route  */
Route::post('listing-review', [FrontendController::class, 'submitReview'])->name('listing-review.store')->middleware('auth');

/** Claim Route  */
Route::post('listing-claim', [FrontendController::class, 'submitClaim'])->name('submit-claim');

/** Blog Route  */
Route::get('blog', [FrontendController::class, 'blog'])->name('blog.index');
Route::get('blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::post('blog-comment', [FrontendController::class, 'submitBlogComment'])->name('blog-comment.store')->middleware('auth');

/** About Route  */
Route::get('about-us', [FrontendController::class, 'aboutIndex'])->name('about.index');

/** Contact Route  */
Route::get('contact-us', [FrontendController::class, 'contactIndex'])->name('contact.index');
Route::post('contact-us', [FrontendController::class, 'contactMessage'])->name('contact.message');

/** Privacy Policy Route  */
Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy.index');

/** Terms and Conditions Route  */
Route::get('terms-and-conditions', [FrontendController::class, 'termsAndConditions'])->name('terms-and-conditions.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password-update', [ProfileController::class, 'updatePassword'])->name('profile-password.update');

    /** Messages */
    Route::get('/messages', [ChatController::class, 'index'])->name('messages');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');
    Route::get('/get-messages', [ChatController::class, 'getMessages'])->name('get-messages');


    /** Agent Listing Routes  */
    Route::resource('/listing', AgentListingController::class);

    /** Listing Image Galllery Routes  */
    Route::resource('/listing-image-gallery', AgentListingImageGalleryController::class);

    /** Listing Video Galllery Routes  */
    Route::resource('/listing-video-gallery', AgentListingVideoGalleryController::class);


    /** Listing Schedule Routes  */
    Route::get('/listing-schedule/{listing_id}', [AgentListingScheduleController::class, 'index'])->name('listing-schedule.index');
    Route::get('/listing-schedule/{listing_id}/create', [AgentListingScheduleController::class, 'create'])->name('listing-schedule.create');
    Route::post('/listing-schedule/{listing_id}', [AgentListingScheduleController::class, 'store'])->name('listing-schedule.store');
    Route::get('/listing-schedule/{id}/edit', [AgentListingScheduleController::class, 'edit'])->name('listing-schedule.edit');
    Route::put('/listing-schedule/{id}', [AgentListingScheduleController::class, 'update'])->name('listing-schedule.update');
    Route::delete('/listing-schedule/{id}', [AgentListingScheduleController::class, 'destroy'])->name('listing-schedule.destroy');

    /** Orders Routes  */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    /** Review Routes  */

    Route::resource('/reviews', ReviewController::class);
});

/** Payment Routes  */

Route::group(['middleware' => 'auth'], function () {
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

    /** Paypal Payment Routes  */
    Route::get('/paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    /** Stripe Payment Routes  */
    Route::get('/stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('/stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('/stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');


    /** Razorpay Payment Routes  */
    Route::get('/razorpay/redirect', [PaymentController::class, 'razorPayRedirect'])->name('razorpay.redirect');
    Route::post('/razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');
});

require __DIR__ . '/auth.php';
