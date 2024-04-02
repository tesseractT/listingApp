<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ListingVideoGallerry;
use Illuminate\Http\RedirectResponse;
use App\Models\Listing;
use Illuminate\Http\Response;

class ListingVideoGalleryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:listing index', ['only' => ['index',]]);
        $this->middleware('permission:listing create', ['only' => ['store']]);
        $this->middleware('permission:listing delete', ['only' => ['destroy']]);
    }
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
        $request->validate(
            [
                'video_url' => ['required', 'url'],
                'listing_id' => ['required']
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
