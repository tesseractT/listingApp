<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TestimonialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialCreateRequest;
use App\Http\Requests\Admin\TestimonialUpdateRequest;
use App\Models\Testimonial;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use FileUploadTrait;

    function __construct()
    {
        $this->middleware('permission:testimonial index', ['only' => ['index',]]);
        $this->middleware('permission:testimonial update', ['only' => ['update', 'edit']]);
        $this->middleware('permission:testimonial create', ['only' => ['create', 'store']]);
        $this->middleware('permission:testimonial delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(TestimonialDataTable $testimonialDataTable): View | JsonResponse
    {
        return $testimonialDataTable->render('admin.testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'image');

        $testimonial = new Testimonial();
        $testimonial->image = $imagePath;
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->rating = $request->rating;
        $testimonial->description = $request->description;
        $testimonial->status = $request->status;
        $testimonial->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialUpdateRequest $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $imagePath = $this->uploadImage($request, 'image', $request->old_image);

        $testimonial->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->rating = $request->rating;
        $testimonial->description = $request->description;
        $testimonial->status = $request->status;
        $testimonial->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Testimonial::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
