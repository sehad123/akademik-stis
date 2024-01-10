<?php

namespace App\Http\Controllers;

use App\Models\ChatModel;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $data['header_title'] = "My Chat";
        $sender_id = Auth::user()->id;
        if (!empty($request->receiver_id)) {
            $receiver_id = base64_decode($request->receiver_id);
            if ($receiver_id == $sender_id) {
                return redirect()->back()->with('error', 'Due to some error please try again');
            }
            $data['getReceiver'] = User::getSingle($receiver_id);
        }
        return view('chat.list', $data);
    }
    public function submit_message(Request $request)
    {
        if ($request->ajax()) {
            $chat = new ChatModel;
            $chat->sender_id = Auth::user()->id;
            $chat->receiver_id = $request->receiver_id;
            $chat->message = $request->message;
            $chat->created_date = time();
            $chat->save();

            $json['success'] = true;
            return response()->json($json);
        } else {
            // Tindakan lain jika bukan request AJAX
            return redirect()->back();
        }
    }
}
