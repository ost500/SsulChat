<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chatting;
use App\Like;
use App\Ssul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChattingController extends Controller
{
    public function chattings(Request $request, $id, $channelId=1)
    {
        if (!Auth::check()) {
            $user = Auth::loginUsingId(1);

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
        return view('chatting', compact('ssuls', 'chats', 'thisChannel', 'popularChats', 'likes', 'user'));
    }

}
