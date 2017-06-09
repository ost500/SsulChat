<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chatting;
use App\Ssul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChattingController extends Controller
{
    public function chattings()
    {
        $chats = Chatting::get();
        $ssuls = Ssul::with('channels')->get();

        if(!Auth::check()){
            Auth::loginUsingId(1);
        }

        return view('chatting',compact('ssuls'), compact('chats'));
    }
}
