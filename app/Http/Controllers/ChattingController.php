<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChattingController extends Controller
{
    public function chattings()
    {
        if(!Auth::check()){
            Auth::loginUsingId(1);
        }

        return view('chat');
    }
}
