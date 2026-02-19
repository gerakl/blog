<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'message' => 'required|string|max:1000',
        ]);

        broadcast(new ChatMessageSent($request->username, $request->message))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}
