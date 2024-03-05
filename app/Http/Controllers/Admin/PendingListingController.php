<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PendingListingDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Listing;

class PendingListingController extends Controller
{
    function index(PendingListingDataTable $pendingListingDataTable): View | JsonResponse
    {
        return $pendingListingDataTable->render('admin.pending-listing.index');
    }

    function update(Request $request): Response
    {
        $request->validate([
            'value' => ['boolean'],
        ]);
        try {
            $listing = Listing::findOrFail($request->id);
            $listing->is_approved = $request->value;
            $listing->save();
            return response(['status' => 'success', 'message' => 'Listing status updated successfully']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
