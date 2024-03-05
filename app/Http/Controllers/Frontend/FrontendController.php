<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Hero;
use App\Models\Category;
use App\Models\Listing;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $categories = Category::where('status', 1,)->get();
        return view('frontend.home.index', compact('hero', 'categories'));
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
        $similarListings = Listing::with(['location', 'category'])->where(['status' => 1, 'is_verified' => 1])->where('category_id', $listing->category_id)->where('id', '!=', $listing->id)->latest()->limit(3)->get();
        return view('frontend.pages.listing-view', compact('listing', 'similarListings'));
    }
}
