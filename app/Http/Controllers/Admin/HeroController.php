<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Hero;

class HeroController extends Controller
{
    use FileUploadTrait;

    function __construct()
    {
        $this->middleware('permission:section index', ['only' => ['index',]]);
        $this->middleware('permission:section update', ['only' => ['update',]]);
    }
    function index(): View
    {
        $hero = Hero::first();
        return view('admin.hero.index', compact('hero'));
    }

    function update(HeroUpdateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'background', '$request->old_background');
        Hero::updateOrCreate(
            ['id' => 1],
            [
                'id' => 1, // This is required for updateOrCreate method, otherwise it will try to create a new record instead of updating the existing one
                'background' => !empty($imagePath) ? $imagePath : $request->old_background,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]
        );
        return redirect()->back()->with('success', 'Hero section updated successfully');
    }
}
