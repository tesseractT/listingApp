<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Hero;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        return view('frontend.home.index', compact('hero'));
    }
}
