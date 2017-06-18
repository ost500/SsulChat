<?php

namespace App\Http\Controllers;

use App\Channel;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;


class MainController extends Controller
{

    public function main()
    {
        $channels = Channel::get();

        return view('main', compact('channels'));
    }

    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();

    }

    public function facebookCallback(Request $request)
    {

        $fbUser = Socialite::driver('facebook')->user();

        $user = User::where('email', $fbUser->email)->first();

        if ($user == null) {
            $newUser = new User();

            $newUser->name = $fbUser->name;
            $newUser->email = $fbUser->email;
            $newUser->password = $fbUser->id;
            $newUser->profile_img = $fbUser->avatar;
            $newUser->save();

            Auth::loginUsingId($newUser->id);
        } else {
            Auth::loginUsingId($user->id);
        }

        return redirect()->intended();
    }
}
