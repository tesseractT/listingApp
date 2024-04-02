<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndConditions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TermsAndConditionsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:terms and conditions index');
    }
    function index(): View
    {
        $termsAndCondition = TermsAndConditions::first();
        return view('admin.terms-and-conditions.index', compact('termsAndCondition'));
    }

    function update(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => ['required', 'string']
        ]);

        TermsAndConditions::updateOrCreate(

            ['id' => 1],
            ['description' => $request->description]
        );

        return redirect()->back()->with('success', 'Terms and Conditions updated successfully');
    }
}
