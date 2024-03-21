<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Chat;

class ChatController extends Controller
{
    function index(): View
    {
        return view('frontend.dashboard.message.index');
    }

    function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => ['required', 'integer'],
            'message' => ['required', 'string', 'max:1000'],
            'listing_id' => ['required', 'integer'],
        ]);

        $chat = new Chat();
        $chat->listing_id = $request->listing_id;
        $chat->sender_id = auth()->user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->save();

        return response(['status' => 'success', 'message' => 'Message sent successfully.']);
    }
}
