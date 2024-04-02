<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PackageDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Admin\PackageStoreRequest;
use App\Models\Package;

class PackageController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:package index', ['only' => ['index',]]);
        $this->middleware('permission:package update', ['only' => ['update', 'edit']]);
        $this->middleware('permission:package create', ['only' => ['create', 'store']]);
        $this->middleware('permission:package delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PackageDataTable $dataTable): View | JsonResponse
    {
        return $dataTable->render('admin.package.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageStoreRequest $request): RedirectResponse
    {
        $package = new Package();
        $package->type = $request->type;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->num_of_days = $request->num_of_days;
        $package->num_of_listings = $request->num_of_listings;
        $package->num_of_photos = $request->num_of_photos;
        $package->num_of_videos = $request->num_of_videos;
        $package->num_of_amenities = $request->num_of_amenities;
        $package->num_of_featured_listing = $request->num_of_featured_listing;
        $package->show_at_home = $request->show_at_home;
        $package->status = $request->status;
        $package->save();

        return to_route('admin.package.index')->with('success', 'Package created successfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $package = Package::find($id);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageStoreRequest $request, string $id): RedirectResponse
    {
        $package = Package::find($id);
        $package->type = $request->type;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->num_of_days = $request->num_of_days;
        $package->num_of_listings = $request->num_of_listings;
        $package->num_of_photos = $request->num_of_photos;
        $package->num_of_videos = $request->num_of_videos;
        $package->num_of_amenities = $request->num_of_amenities;
        $package->num_of_featured_listing = $request->num_of_featured_listing;
        $package->show_at_home = $request->show_at_home;
        $package->status = $request->status;
        $package->save();

        return to_route('admin.package.index')->with('success', 'Package updated successfully');
    }

    //


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $package = Package::findOrFail($id);
            $package->delete();
            return response()->json(['status' => 'success', 'message' => 'Package has been deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
