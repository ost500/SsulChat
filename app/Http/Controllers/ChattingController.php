<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chatting;
use App\Ssul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChattingController extends Controller
{
    public function chattings($id)
    {
        $chats = Chatting::orderBy('created_at', 'desc')->paginate(20);
        $ssuls = Ssul::with('channels')->with('teams')->get();

        $thisSsul = Ssul::with('channels')->with('teams')->findOrFail($id);

        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }

//        return $ssuls->toJson();
        return view('chatting', compact('ssuls', 'chats', 'thisSsul'));
    }
}
