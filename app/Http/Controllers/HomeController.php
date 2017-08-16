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

        $myChattings = User::with('chattings.ssuls')->find($user->id);

//        return response()->json($myChattings);

        return view('mypage', compact('user', 'myChattings'));
    }
    public function mypagePost(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();


        return redirect()->back();
    }

    public function myPicturePost(Request $request)
    {
        $user = Auth::user();

        print_r($request->all());

        if ($request->hasFile('picture')) {

            // pictureFile = file
            $pictureFile = $request->file('picture');
            // name
            $filename = $pictureFile->getClientOriginalName();
            // path
            $destinationPath = '/picture/users_picture/';
            // save the name with path
            $user->profile_img = $destinationPath . $user->id . '_' . $filename;
            // upload
            $pictureFile->move(public_path() . $destinationPath, $user->profile_img);

        }
        $user->save();

        print_r($user);

//        return redirect()->back();
    }
}
