<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Events\Message;
use App\Models\Chat;

class ChatController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:message index');
    }
    function index(): View
    {
        $receiverId = auth()->user()->id;

        $senders = Chat::with(['senderProfile', 'listingProfile'])->select(['sender_id', 'listing_id'])
            ->where('receiver_id', $receiverId)
            ->where('sender_id', '!=', $receiverId)
            ->selectRaw('MAX(created_at) as last_message_time')
            ->groupBy('sender_id', 'listing_id')
            ->orderBy('last_message_time', 'desc')
            ->get();
        return view('admin..message.index', compact('senders'));
    }

    function getMessages(Request $request)
    {
        $receiverId = auth()->user()->id;
        $senderId = $request->sender_id;
        $listingId = $request->listing_id;

        $messages = Chat::with('senderProfile')->whereIn('receiver_id', [$senderId, $receiverId])
            ->whereIn('sender_id', [$senderId, $receiverId])
            ->where('listing_id', $listingId)
            ->orderBy('created_at', 'asc')
            ->get();

        Chat::where([
            'receiver_id' => $receiverId,
            'sender_id' => $senderId,
            'listing_id' => $listingId,
            'seen' => 0,
        ])->update(['seen' => 1]);

        return response($messages);
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
}
