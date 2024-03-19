<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Review;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    function index(ReviewDataTable $reviewDataTable): View | JsonResponse
    {
        return $reviewDataTable->render('admin.listing.listing-review.index');
    }

    /** Update Review Status */
    function updateStatus(String $id): Response
    {
        $review = Review::findOrFail($id);
        $review->is_approved = !$review->is_approved;
        $review->save();
        return response(['status' => 'success', 'message' => 'Review status updated successfully']);
    }

    /** Delete Review */
    function destroy(String $id): Response
    {
        try {
            $package = Review::findOrFail($id);
            $package->delete();
            return response()->json(['status' => 'success', 'message' => 'Review has been deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
