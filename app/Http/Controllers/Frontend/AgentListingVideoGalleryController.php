<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingVideoGallerry;
use App\Models\Listing;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Rules\MaxVideos;
use App\Models\Subscription;

class AgentListingVideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $videos = ListingVideoGallerry::where('listing_id', request()->id)->get();
        $listingTitle = Listing::select('title')->where('id', request()->id)->first();
        $subscription = Subscription::with('package')->where('user_id', auth()->id())->first();

        return view('frontend.dashboard.listing.video-gallery.index', compact('videos', 'listingTitle', 'subscription'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'video_url' => ['required', 'url'],
                'listing_id' => ['required', new MaxVideos]
            ],
            [
                'video_url.unique' => 'This video is already added to the gallery.'
            ]
        );

        $video = new ListingVideoGallerry();
        $video->listing_id = $request->listing_id;
        $video->video_url = $request->video_url;
        $video->save();

        return redirect()->back()->with('success', 'Video added successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            $video = ListingVideoGallerry::findOrFail($id);
            $video->delete();
            return response(['status' => 'success', 'message' => 'Video deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
