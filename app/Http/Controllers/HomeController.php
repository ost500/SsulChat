<?php

namespace App\Http\Controllers;

use App\Chatting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function chat()
    {


        //return view('chat');
    }

    public function fbtest()
    {


        return view('fbtest');
    }

    public function mypage()
    {
        $user = Auth::user();

        $myChattings = User::where('users.id', Auth::user()->id)
            ->rightJoin('chattings', 'users.id', '=', 'chattings.user_id')->get();

        return view('mypage', compact('user', 'myChattings'));
    }
}
