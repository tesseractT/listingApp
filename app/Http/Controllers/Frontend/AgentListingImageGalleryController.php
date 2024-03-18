<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ListingImageGallerry;
use App\Models\Listing;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Rules\MaxImages;

class AgentListingImageGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $images =  ListingImageGallerry::where('listing_id', request()->id)->get();
        $listingTitle = Listing::select('title')->where('id', request()->id)->first();
        $subscription = Subscription::with('package')->where('user_id', auth()->id())->first();
        return view('frontend.dashboard.listing.image-gallery.index', compact('images', 'listingTitle', 'subscription'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'images' => ['required'],
            'images.*' => ['image', 'max:3000'],
            'listing_id' => ['required', new MaxImages]
        ], [
            'images.*.image' => 'All files must be an image format (jpeg, png, jpg)',
            'images.*.max' => 'A file may not be greater than 3MB'

        ]);

        $imagePaths = $this->uploadMultipleImage($request, 'images');

        foreach ($imagePaths as $path) {
            $image = new ListingImageGallerry();
            $image->listing_id = $request->listing_id;
            $image->image = $path;
            $image->save();
        }

        return redirect()->back()->with('success', 'Images uploaded successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            $image = ListingImageGallerry::findOrFail($id);
            $this->deleteFile($image->image);
            $image->delete();

            return response(['status' => 'success', 'message' => 'Image deleted successfully']);
        } catch (\Exception $e) {

            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
