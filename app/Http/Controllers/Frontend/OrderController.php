<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;

class OrderController extends Controller
{
    function index(UserOrderDataTable $userOrderDataTable): View | JsonResponse
    {
        return $userOrderDataTable->render('frontend.dashboard.order.index');
    }

    function show(string $id): View
    {
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.order.show', compact('order'));
    }
}
