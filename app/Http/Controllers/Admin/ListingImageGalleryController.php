<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\ListingImageGallerry;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ListingImageGalleryController extends Controller
{

    use FileUploadTrait;

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
        $images =  ListingImageGallerry::where('listing_id', request()->id)->get();
        $listingTitle = Listing::select('title')->where('id', request()->id)->first();
        return view('admin.listing.listing-image-gallery.index', compact('images', 'listingTitle'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'images' => ['required'],
            'images.*' => ['image', 'max:3000'],
            'listing_id' => ['required']
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
