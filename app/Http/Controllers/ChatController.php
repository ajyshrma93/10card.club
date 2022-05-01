<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function sendMessage(Request $request)
    {
        try {
            $chat = new Chat();
            $chat->user_id = auth()->id();
            $chat->message = nl2br($request->message);
            $chat->application_id = $request->application_id;
            $chat->save();
            $reposne['status'] = 200;
            $html = view('includes.chat_messages', compact('chat'))->render();

            $reposne['html'] = $html;
        } catch (\Exception $e) {
            $reposne['status'] = 204;
            $reposne['errot'] = $e->getMessage();
        }


        return response()->json($reposne);
    }


    public function loadMessage(Request $request)
    {
        $messages = Chat::where(['application_id' => $request->application_id, 'is_new' => 1])->where('user_id', '!=', auth()->id())->get();
        $reposne['status'] = 200;
        $html = '';
        foreach ($messages as $chat) {
            $html .= view('includes.chat_messages', compact('chat'))->render();
        }

        $reposne['html'] = $html;
        return response()->json($reposne);
    }
}
