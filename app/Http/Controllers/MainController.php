<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Ssul;
use App\Team;
use App\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;


class MainController extends Controller
{

    public function main()
    {
        $builder = Ssul::join('channels', 'channels.ssul_id', '=', 'ssuls.id')
            ->leftjoin('chattings', 'chattings.channel_id', '=', 'channels.id')
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
            ->leftjoin('chattings', 'chattings.channel_id', '=', 'channels.id')
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

    public function search_json(Request $request)
    {
        $ssuls = Ssul::where('name', 'like', "%" . $request->keyword . "%")->limit(5)->get();

        return response()->json($ssuls);
    }

    public function ssul(Request $request)
    {
        return view('ssul');
    }

    public function ssulCreate(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'team1' => 'required|max:20',
            'team2' => 'required|max:20',
        ], [
            'name.required' => '썰 제목은 필수 입니다.',
            'team1.required' => '세력1은 필수 입니다.',
            'team1.max' => '세력명이 너무 깁니다.',
            'team2.required' => '세력2는 필수 입니다.',
            'team2.max' => '세력명이 너무 깁니다.',
        ])->validate();

        print_r($request->all());

        $ssul = new Ssul();

        DB::transaction(function () use ($request, &$ssul) {

            $ssul->name = $request->name;
            $ssul->save();

            $team = new Team();
            $team->ssul_id = $ssul->id;
            $team->name = $request->team1;
            $team->value = 50;
            $team->save();

            $team = new Team();
            $team->ssul_id = $ssul->id;
            $team->name = $request->team2;
            $team->value = 50;
            $team->save();

            $newChannel = new Channel();
            $newChannel->name = 1;
            $newChannel->ssul_id = $ssul->id;
            $newChannel->save();
        });

        return redirect()->route('chattings', ['id' => $ssul->id]);

    }
}
