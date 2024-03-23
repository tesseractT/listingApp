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
        $senderId = auth()->user()->id;
        $receivers = Chat::with(['receiverProfile', 'listingProfile'])->select(['receiver_id', 'listing_id'])
            ->where('sender_id', $senderId)
            ->where('receiver_id', '!=', $senderId)
            ->groupBy('receiver_id', 'listing_id')
            ->get();
        return view('frontend.dashboard.message.index', compact('receivers'));
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

    function getMessages(Request $request)
    {
        $senderId = auth()->user()->id;
        $receiverId = $request->receiver_id;
        $listingId = $request->listing_id;

        $messages = Chat::with('senderProfile')->whereIn('receiver_id', [$senderId, $receiverId])
            ->whereIn('sender_id', [$senderId, $receiverId])
            ->where('listing_id', $listingId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response($messages);
    }
}
