<?php

namespace App\Http\Controllers\Frontend;

use Session;
use App\Models\Blog;
use App\Models\Hero;
use App\Models\Claim;
use App\Models\Review;
use App\Models\Amenity;
use App\Models\Counter;
use App\Models\Listing;
use App\Models\Package;
use App\Models\Category;
use App\Models\Location;
use Illuminate\View\View;
use App\Models\OurFeature;
use App\Events\CreateOrder;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ListingSchedule;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $counter = Counter::first();
        $blogs = Blog::with('author')->where('status', 1)->latest()->limit(3)->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $ourFeatures = OurFeature::where('status', 1)->get();
        $categories = Category::where('status', 1,)->get();
        $locations = Location::where('status', 1)->get();
        $packages = Package::where('status', 1)->where('show_at_home', 1)->limit(3)->get();
        $featuredCategories = Category::withCount(['listings' => function ($query) {
            $query->where('is_approved', 1);
        }])->where(['show_at_home' => 1, 'status' => 1])->take(6)->get();

        // Featured Locations
        $featuredLocations = Location::with(['listings' => function ($query) {
            $query->withAvg(['reviews' => function ($query) {
                $query->where('is_approved', 1);
            }], 'rating')
                ->withCount(['reviews' => function ($query) {
                    $query->where('is_approved', 1);
                }])
                ->where(['is_approved' => 1, 'status' => 1])->orderBy('id', 'desc')->limit(3);
        }])->where(['show_at_home' =>  1, 'status' => 1])->get();

        // Featured Listings
        $featuredListings = Listing::withAvg(['reviews' => function ($query) {
            $query->where('is_approved', 1);
        }], 'rating')
            ->withCount(['reviews' => function ($query) {
                $query->where('is_approved', 1);
            }])->where(['is_approved' => 1, 'status' => 1, 'is_featured' => 1])->orderBy('id', 'desc')->limit(10)->get();
        return view(
            'frontend.home.index',
            compact(
                'hero',
                'categories',
                'packages',
                'featuredCategories',
                'featuredLocations',
                'featuredListings',
                'locations',
                'ourFeatures',
                'counter',
                'testimonials',
                'blogs'
            )
        );
    }

    function listings(Request $request): View
    {
        $listings = Listing::withAvg(['reviews' => function ($query) {
            $query->where('is_approved', 1);
        }], 'rating')
            ->withCount(['reviews' => function ($query) {
                $query->where('is_approved', 1);
            }])
            ->with(['location', 'category'])->where(['status' => 1, 'is_approved' => 1]);

        $listings->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
            return $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        });

        $listings->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        });

        $listings->when($request->has('location') && $request->filled('location'), function ($query) use ($request) {
            $query->whereHas('location', function ($subQuery) use ($request) {
                $subQuery->where('slug', $request->location);
            });
        });

        $listings->when($request->has('amenity') && is_array($request->amenity), function ($query) use ($request) {
            $amenityIds  = Amenity::whereIn('slug', $request->amenity)->pluck('id');

            $query->whereHas('amenities', function ($subQuery) use ($amenityIds) {
                $subQuery->whereIn('amenity_id', $amenityIds);
            });
        });

        $listings = $listings->latest()->paginate(12);
        $categories = Category::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        $amenities = Amenity::where('status', 1)->get();
        return view('frontend.pages.listings', compact('listings', 'categories', 'locations', 'amenities'));
    }

    function listingModal(string $id)
    {
        $listing = Listing::findOrFail($id);
        return view('frontend.layouts.ajax-listing-modal', compact('listing'))->render();
    }

    function showListing(string $slug): View
    {
        $listing = Listing::with(['location', 'category'])->withAvg(['reviews' => function ($query) {
            $query->where('is_approved', 1);
        }], 'rating')
            ->where(['status' => 1, 'is_verified' => 1])
            ->where('slug', $slug)->first();
        // dd($listing);
        $listing->increment('views');

        $isOpen = $this->listingScheduleStatus($listing);
        $reviews = Review::with('user')->where(['listing_id' => $listing->id, 'is_approved' => 1])->paginate(10);

        $similarListings = Listing::with(['location', 'category'])->where(['status' => 1, 'is_verified' => 1])->where('category_id', $listing->category_id)->where('id', '!=', $listing->id)->latest()->limit(3)->get();
        return view('frontend.pages.listing-view', compact('listing', 'similarListings', 'isOpen', 'reviews'));
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
        // dd(strtolower(date('l')));
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

    function submitReview(Request $request): RedirectResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'review' => ['required', 'string', 'max:500'],
            'listing_id' => ['required', 'integer', 'exists:listings,id']
        ]);

        $prevReview = Review::where(['listing_id' => $request->listing_id, 'user_id' => auth()->user()->id])->exists();
        if ($prevReview) {
            throw ValidationException::withMessages(['review' => 'You have already submitted a review for this listing']);
        }

        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->listing_id = $request->listing_id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        return back()->with('success', 'Review Submitted Successfully');
    }

    function submitClaim(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'claim' => ['required', 'string', 'max:500'],
            'listing_id' => ['required', 'integer', 'exists:listings,id']
        ]);

        $prevClaim = Claim::where(['listing_id' => $request->listing_id, 'email' => $request->email])->exists();
        if ($prevClaim) {
            throw ValidationException::withMessages(['claim' => 'You have already submitted a claim for this listing, please wait while we finish our investigations.']);
        }

        $claim = new Claim();
        $claim->name = $request->name;
        $claim->email = $request->email;
        $claim->claim = $request->claim;
        $claim->listing_id = $request->listing_id;
        $claim->save();

        return back()->with('success', 'Claim Submitted Successfully');
    }

    function blog(Request $request): View
    {
        $blogs = Blog::with('category')->where('status', 1)->orderBy('id', 'desc')
            ->when($request->has('search') && $request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('category') && $request->filled('category'), function ($query) use ($request) {
                $category = BlogCategory::select('id', 'slug')->where('slug', $request->category)->first();
                $query->where('blog_category_id', $category->id);
            })
            ->paginate(9);
        return view('frontend.pages.blog', compact('blogs'));
    }

    function blogShow(string $slug): View
    {
        $categories = BlogCategory::withCount(['blogs' => function ($query) {
            $query->where('status', 1);
        }])->where('status', 1)->get();
        $blog = Blog::with(['category', 'comments'])->where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $popularBlogs = Blog::select(['id', 'title', 'slug', 'created_at', 'image'])->where('id', '!=', $blog->id)
            ->where('is_popular', 1)
            ->where('status', 1)->orderBy('id', 'desc')->take(5)->get();
        return view('frontend.pages.blog-show', compact('blog', 'popularBlogs', 'categories'));
    }

    function submitBlogComment(Request $request): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:500'],
            'blog_id' => ['required', 'integer', 'exists:blogs,id']
        ]);

        $comment = new BlogComment();
        $comment->user_id = auth()->user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->comment = $request->comment;
        $comment->save();

        return back()->with('success', 'Comment Submitted Successfully And Awaiting Approval');
    }
}
