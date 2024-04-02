<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:blog index', ['only' => ['index',]]);
        $this->middleware('permission:blog update', ['only' => ['update', 'edit']]);
        $this->middleware('permission:blog create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $blogCategoryDataTable): View | JsonResponse
    {
        return $blogCategoryDataTable->render('admin.blog.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:25|unique:blog_categories,name',
            'status' => 'required|boolean',
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.blog-category.index')->with('success', 'Category created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog.blog-category.edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
            'status' => 'required|boolean',
        ]);

        $category = BlogCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.blog-category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            BlogCategory::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
