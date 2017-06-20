<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chatting;
use App\Like;
use App\Ssul;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mockery\Exception;
use Redis;

class ChattingController extends Controller
{
    public function chattings(Request $request, $id, $channelId = 0)
    {
        if ($channelId == 0) {
            $channelId = Ssul::find($id)->channels->first()->id;
        }

        $loginMembers = null;

        if (!Auth::check()) {

            $loginMembers = Redis::get("presence-newMessage{$channelId}:members");

            $loginMembers = json_decode($loginMembers);

            $users = User::where('annony', true)->pluck('id');
            $users = $users->toArray();


            foreach ($loginMembers as $member) {
                $rmArr = array($member->user_info->id);
                $users = array_diff($users, $rmArr);
            }


            $user = null;

            if (!is_null($users)) {
                $user = Auth::loginUsingId($users[1]);
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

// 익명이면 익명아이디 발행
        if ($user->id == 1) {
            $user->name = "익명" . dechex(str_slug($request->getClientIp(), ''));
        }

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
        return view('chatting', compact('ssuls', 'chats', 'thisChannel', 'popularChats', 'likes', 'user', 'loginMembers'));
    }

}
