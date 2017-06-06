<?php

namespace App\Http\Controllers;

use App\Chatting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChattingController extends Controller
{
    public function chattings()
    {

        $chats = Chatting::get();
        if(!Auth::check()){
            Auth::loginUsingId(1);
        }

        return view('chatting', compact('chats'));
    }
}
