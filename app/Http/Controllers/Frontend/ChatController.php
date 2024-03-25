<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Chat;
use App\Events\Message;

class ChatController extends Controller
{
    function index(): View
    {
        $senderId = auth()->user()->id;
        $receivers = Chat::with(['receiverProfile', 'listingProfile'])->select(['receiver_id', 'listing_id'])
            ->where('sender_id', $senderId)
            ->where('receiver_id', '!=', $senderId)
            ->selectRaw('MAX(created_at) as last_message_time')
            ->groupBy('receiver_id', 'listing_id')
            ->orderBy('last_message_time', 'desc')
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

        // broadaast message
        broadcast(new Message($chat->message, $chat->listing_id, $chat->receiver_id));

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

        Chat::where([
            'receiver_id' => $senderId,
            'sender_id' => $receiverId,
            'listing_id' => $listingId,
            'seen' => 0,
        ])->update(['seen' => 1]);

        return response($messages);
    }
}
