<?php

namespace App\Http\Controllers\Frontend;

use App\Events\CreateOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Hero;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ListingSchedule;
use App\Models\Package;
use Session;
use Illuminate\Http\RedirectResponse;
use App\Models\Location;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $categories = Category::where('status', 1,)->get();
        $packages = Package::where('status', 1)->where('show_at_home', 1)->limit(3)->get();
        $featuredCategories = Category::withCount(['listings' => function ($query) {
            $query->where('is_approved', 1);
        }])->where(['show_at_home' => 1, 'status' => 1])->take(6)->get();
        $featuredLocations = Location::with(['listings' => function ($query) {
            $query->where(['is_approved' => 1, 'status' => 1])->orderBy('id', 'desc')->limit(3);
        }])->where(['show_at_home' =>  1, 'status' => 1])->get();
        $featuredListings = Listing::where(['is_approved' => 1, 'status' => 1, 'is_featured' => 1])->orderBy('id', 'desc')->limit(10)->get();
        return view(
            'frontend.home.index',
            compact(
                'hero',
                'categories',
                'packages',
                'featuredCategories',
                'featuredLocations',
                'featuredListings'
            )
        );
    }

    function listings(Request $request): View
    {
        $listings = Listing::with(['location', 'category'])->where(['status' => 1, 'is_approved' => 1]);
        $listings->when($request->has('category'), function ($query) use ($request) {
            return $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        });
        $listings = $listings->latest()->paginate(12);
        return view('frontend.pages.listings', compact('listings'));
    }

    function listingModal(string $id)
    {
        $listing = Listing::findOrFail($id);
        return view('frontend.layouts.ajax-listing-modal', compact('listing'))->render();
    }

    function showListing(string $slug): View
    {
        $listing = Listing::with(['location', 'category'])->where(['status' => 1, 'is_verified' => 1])->where('slug', $slug)->first();
        $listing->increment('views');

        $isOpen = $this->listingScheduleStatus($listing);

        $similarListings = Listing::with(['location', 'category'])->where(['status' => 1, 'is_verified' => 1])->where('category_id', $listing->category_id)->where('id', '!=', $listing->id)->latest()->limit(3)->get();
        return view('frontend.pages.listing-view', compact('listing', 'similarListings', 'isOpen'));
    }

    function listingScheduleStatus(Listing $listing): ?string
    {
        $isOpen = '';
        $day = ListingSchedule::where('listing_id', $listing->id)->where('day', strtolower(date('l')))->first();
        if ($day) {
            $startTime = strtotime($day->start_time);
            $endTime = strtotime($day->end_time);
            if (time() >= $startTime && time() <= $endTime) {
                $isOpen = 'open';
            } else {
                $isOpen = 'closed';
            }
        }
        return $isOpen;
    }

    function showPackages(): View
    {
        $packages = Package::where('status', 1)->get();
        return view('frontend.pages.packages', compact('packages'));
    }

    function checkout(string $id): View | RedirectResponse
    {

        $package = Package::findOrFail($id);

        /** Store package id in session */
        Session::put('selected_package_id', $package->id);

        /** If package is free then directly place order */
        if ($package->type === 'free' || $package->price == 0) {
            $paymentInfo = [
                'transaction_id' => uniqid(),
                'payment_method' => 'Free',
                'paid_amount' => 0,
                'paid_currency' => config('settings.site_default_currency'),
                'payment_status' => 'Completed'
            ];
            CreateOrder::dispatch($paymentInfo);

            return redirect()->route('user.dashboard')->with('success', 'Successfully Subscribed to Free Package');
        }
        return view('frontend.pages.checkout', compact('package'));
    }
}
