<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCommentDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogCommentController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:blog comment');
    }
    function index(BlogCommentDataTable $blogCommentDataTable): View | JsonResponse
    {
        return $blogCommentDataTable->render('admin.blog.blog-comment.index');
    }

    function updateCommentStatus(Request $request): Response
    {
        $request->validate([
            'status' => ['required', 'boolean'],
            'id' => ['required', 'integer'],
        ]);

        $comment = BlogComment::findOrFail($request->id);
        $comment->status = $request->status;
        $comment->save();

        return response(['message' => 'Comment status updated successfully.']);
    }

    function destroy(String $id): Response
    {
        try {
            BlogComment::findOrFail($id)->delete();
            return response(['status' => 'success', 'message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
