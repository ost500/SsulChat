<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Ssul;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;


class MainController extends Controller
{

    public function main()
    {
        $builder = Ssul::join('channels', 'channels.ssul_id', '=', 'ssuls.id')
            ->join('chattings', 'chattings.channel_id', '=', 'channels.id')
            ->groupBy('ssuls.id')
            ->selectRaw("ssuls.*, count(chattings.id) as chat_count")
            ->orderBy('chat_count', 'desc');


        $channels = $builder->paginate(5);

//        return response()->json($channels);
//
////return response()->json($channels);
        return view('main', compact('channels'));
    }

    public function search(Request $request)
    {
        $question = $request->question;

        $channels = Ssul::join('channels', 'channels.ssul_id', '=', 'ssuls.id')
            ->join('chattings', 'chattings.channel_id', '=', 'channels.id')
            ->groupBy('ssuls.id')
            ->selectRaw("ssuls.*, count(chattings.id) as chat_count")
            ->orderBy('chat_count', 'desc')
            ->where('ssuls.name', 'like', "%{$question}%")
            ->paginate(5);

        return view('main', compact('channels', 'question'));
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
