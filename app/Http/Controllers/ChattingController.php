<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chatting;
use App\Like;
use App\Ssul;
use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;


class ChattingController extends Controller
{
    public function chattings(Request $request, $id, $channelId = 0)
    {
        if (Auth::check() && Auth::user()->annony == true) {
            Auth::logout();
        }

        if ($channelId == 0) {
            $channelId = Ssul::find($id)->channels->first()->id;
        }

        $loginMembers = null;

        // 로그인 안 됐다면 익명
        if (!Auth::check()) {

            $loginMembers = Redis::get("presence-newMessage{$channelId}:members");

            $loginMembers = json_decode($loginMembers);

            $users = User::where('annony', true)->orderby('updated_at')->pluck('id');
            $users = $users->toArray();


            foreach ($loginMembers as $member) {
                $rmArr = array($member->user_info->id);
                $users = array_diff($users, $rmArr);
            }


            $users = array_values($users);

            $user = null;

            if (!is_null($users)) {
                $user = Auth::loginUsingId($users[0]);
                $user->updated_at = Carbon::now();
                $user->save();
            } else {

                for ($i = 0; $i <= 100; $i++) {

                    try {
                        $user = User::create([
                            'name' => '익명' . rand(1, 10000),
                            'email' => "anonymous" . rand(1, 10000) . "@osteng.com",
                            'annony' => true,
                            'profile_img' => '/images/chatpic01.png',
                            'password' => bcrypt('!@#$%^&*()')
                        ]);

                        break;
                    } catch (Exception $e) {

                    }
                }
            }


        } else {
            $user = Auth::user();
        }

        $myTeam = $request->session()->get('myTeam');

        $chats = Chatting::where('channel_id', $channelId)
            ->orderBy('created_at', 'desc')
            ->paginate(20)->sortBy('created_at');

        $likes = Like::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20)->sortBy('created_at');

        $popularChats = Chatting::where('channel_id', $channelId)
            ->has('likes')
            ->with('likes')->withCount('likes')
            ->with('user')
            ->orderBy('likes_count', 'desc')
            ->get();

        $ssuls = Ssul::with('channels')->with('teams')->get();

        $thisChannel = Channel::with('ssul.teams')->with('ssul.channels')->findOrFail($channelId);


//        return $thisChannel->toJson();
        return view('chatting', compact('ssuls', 'chats', 'thisChannel', 'popularChats', 'likes', 'user', 'loginMembers', 'myTeam'));
    }

    public function teamSelect(Request $request)
    {


        Session::put('myTeam', $request->teamSelect);


        return redirect()->back();
    }

}
