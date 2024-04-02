<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterInfoUpdateRequest;
use App\Models\FooterInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FooterInfoController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:footer index');
    }
    function index(): View
    {
        $footerInfo = FooterInfo::first();
        return view('admin.footer-info.index', compact('footerInfo'));
    }

    function update(FooterInfoUpdateRequest $request): RedirectResponse
    {
        FooterInfo::updateOrCreate(
            [
                'id' => 1
            ],

            [
                'short_description' => $request->short_description,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'copyright' => $request->copyright,
            ]
        );
        return redirect()->back()->with('success', 'Footer info updated successfully');
    }
}
