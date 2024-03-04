<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ListingVideoGallerry;
use Illuminate\Http\RedirectResponse;
use App\Models\Listing;

class ListingVideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $videos = ListingVideoGallerry::where('listing_id', request()->id)->get();
        $listingTitle = Listing::select('title')->where('id', request()->id)->first();
        return view('admin.listing.listing-video-gallery.index', compact('videos', 'listingTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'video_url' => ['required', 'url'],
            'listing_id' => ['required']
        ]);

        $video = new ListingVideoGallerry();
        $video->listing_id = $request->listing_id;
        $video->video_url = $request->video_url;
        $video->save();

        return redirect()->back()->with('success', 'Video added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $video = ListingVideoGallerry::findOrFail($id);
            $video->delete();
            return response()->json(['status' => 'success', 'message' => 'Video deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
