<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ListingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListingStoreRequest;
use App\Http\Requests\Admin\ListingUpdateRequest;
use App\Models\Listing;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Location;
use App\Models\Amenity;
use App\Models\ListingAmenity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Str;

class ListingController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ListingDataTable $listingDataTable): View | JsonResponse
    {
        return $listingDataTable->render('admin.listing.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();
        return view('admin.listing.create', compact('categories', 'locations', 'amenities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingStoreRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image');
        $thumbnailPath = $this->uploadImage($request, 'thumbnail_image');
        $attachmentPath = $this->uploadImage($request, 'attachment');


        $listing = new Listing();
        $listing->user_id = Auth::user()->id;
        $listing->package_id = 0;
        $listing->image = $imagePath;
        $listing->thumbnail_image = $thumbnailPath;
        $listing->title = $request->title;
        $listing->slug = Str::slug($request->title);
        $listing->category_id = $request->category;
        $listing->location_id = $request->location;
        $listing->address = $request->address;
        $listing->phone = $request->phone;
        $listing->email = $request->email;
        $listing->website = $request->website;
        $listing->x_link = $request->x_link;
        $listing->facebook_link = $request->facebook_link;
        $listing->linkedin_link = $request->linkedin_link;
        $listing->whatsapp_link = $request->whatsapp_link;
        $listing->file = $attachmentPath;
        $listing->description = $request->description;
        $listing->google_map_embed_code = $request->google_map_embed_code;
        $listing->seo_title = $request->seo_title;
        $listing->seo_description = $request->seo_description;
        $listing->status = $request->status;
        $listing->is_featured = $request->is_featured;
        $listing->is_verified = $request->is_verified;
        $listing->expiry_date = now()->addDays(30);
        $listing->save();

        foreach ($request->amenities as $amenityId) {
            $amenity = new ListingAmenity();
            $amenity->listing_id = $listing->id;
            $amenity->amenity_id = $amenityId;
            $amenity->save();
        }

        return to_route('admin.listing.index')->with('success', 'Listing created successfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $listing = Listing::findOrFail($id);
        $listingAmenities = ListingAmenity::where('listing_id', $listing->id)->pluck('amenity_id')->toArray();

        $categories = Category::all();
        $locations = Location::all();
        $amenities = Amenity::all();
        return view('admin.listing.edit', compact('categories', 'locations', 'amenities', 'listing', 'listingAmenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListingUpdateRequest $request, string $id): RedirectResponse
    {
        $listing = Listing::findOrFail($id);

        $imagePath = $this->uploadImage($request, 'image', $request->old_image);
        $thumbnailPath = $this->uploadImage($request, 'thumbnail_image', $request->old_thumbnail_image);
        $attachmentPath = $this->uploadImage($request, 'attachment', $request->old_attachment);


        $listing->user_id = Auth::user()->id;
        $listing->package_id = 0;
        $listing->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $listing->thumbnail_image = !empty($thumbnailPath) ? $thumbnailPath : $request->old_thumbnail_image;
        $listing->title = $request->title;
        $listing->slug = Str::slug($request->title);
        $listing->category_id = $request->category;
        $listing->location_id = $request->location;
        $listing->address = $request->address;
        $listing->phone = $request->phone;
        $listing->email = $request->email;
        $listing->website = $request->website;
        $listing->x_link = $request->x_link;
        $listing->facebook_link = $request->facebook_link;
        $listing->linkedin_link = $request->linkedin_link;
        $listing->whatsapp_link = $request->whatsapp_link;
        $listing->file = !empty($attachmentPath) ? $attachmentPath : $request->old_attachment;
        $listing->description = $request->description;
        $listing->google_map_embed_code = $request->google_map_embed_code;
        $listing->seo_title = $request->seo_title;
        $listing->seo_description = $request->seo_description;
        $listing->status = $request->status;
        $listing->is_featured = $request->is_featured;
        $listing->is_verified = $request->is_verified;
        $listing->expiry_date = now()->addDays(30);
        $listing->save();

        ListingAmenity::where('listing_id', $listing->id)->delete();

        foreach ($request->amenities as $amenityId) {
            $amenity = new ListingAmenity();
            $amenity->listing_id = $listing->id;
            $amenity->amenity_id = $amenityId;
            $amenity->save();
        }

        return to_route('admin.listing.index')->with('success', 'Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $listing = Listing::findOrFail($id);
            $listing->delete();
            return response()->json(['status' => 'success', 'message' => 'Listing has been deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
