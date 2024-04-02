<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CounterUpdateRequest;
use App\Models\Counter;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CounterController extends Controller
{

    use FileUploadTrait;

    function __construct()
    {
        $this->middleware('permission:section index', ['only' => ['index',]]);
        $this->middleware('permission:section update', ['only' => ['update',]]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $counter = Counter::first();
        return view('admin.counter.index', compact('counter'));
    }


    public function update(CounterUpdateRequest $request, string $id): RedirectResponse
    {
        $imagePath = $this->uploadImage($request, 'background', $request->old_background);
        Counter::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'background' => !empty($imagePath) ? $imagePath : $request->old_background,
                'counter_one' => $request->counter_one,
                'counter_one_title' => $request->counter_one_title,
                'counter_two' => $request->counter_two,
                'counter_two_title' => $request->counter_two_title,
                'counter_three' => $request->counter_three,
                'counter_three_title' => $request->counter_three_title,
                'counter_four' => $request->counter_four,
                'counter_four_title' => $request->counter_four_title,
            ]
        );

        return redirect()->back()->with('success', 'Counter updated successfully');
    }
}
