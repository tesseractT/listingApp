<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order index', ['only' => ['index', 'show', 'update']]);
        $this->middleware('permission:order delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $orderDataTable): View | JsonResponse
    {
        return $orderDataTable->render('admin.order.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $package = Order::findOrFail($id);
            $package->delete();
            return response()->json(['status' => 'success', 'message' => 'Package has been deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
