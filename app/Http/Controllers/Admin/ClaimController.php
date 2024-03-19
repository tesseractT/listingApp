<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClaimDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Claim;
use Illuminate\Http\Response;

class ClaimController extends Controller
{
    function index(ClaimDataTable $dataTable): JsonResponse | View
    {
        return $dataTable->render('admin.claim.index');
    }

    function destroy(Request $request, $id): Response
    {
        try {
            Claim::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
