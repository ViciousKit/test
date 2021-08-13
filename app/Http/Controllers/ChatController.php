<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ChatRoom, ChatMessage, ChatTextColor, User};
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;

class ChatController extends Controller
{
    public function rooms(Request $request) {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId) {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function newMessage(Request $request, $roomId) {
        $newMessage = new ChatMessage;
        $newMessage->chat_room_id = $roomId;
        $newMessage->user_id = Auth::id();
        $newMessage->message = $request->message;
        $newMessage->save();

        broadcast( new NewChatMessage( $newMessage))->toOthers();
        return $newMessage;
    }

    public function getChatTextColors() {
        return ChatTextColor::all();
    }

    public function setUserChatTextColor(Request $request) {
         User::find(Auth::id())->update(['chat_text_color_id' => $request->colorId]);
//        return User::find(Auth::id());

    }
}
