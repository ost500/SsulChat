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

        $ssul = Ssul::find($id);

        if ($channelId == 0) {

            $channelId = $ssul->channels->first()->id;
        }

        $loginMembers = null;

        // 로그인 안 됐다면 익명
        if (!Auth::check()) {

            $loginMembers = Redis::get("presence-newMessage{$channelId}:members");

            $loginMembers = json_decode($loginMembers);

            $users = User::where('annony', true)->orderby('updated_at')->pluck('id');
            $users = $users->toArray();


            if (!is_null($loginMembers)) {
                foreach ($loginMembers as $member) {
                    $rmArr = array($member->user_info->id);
                    $users = array_diff($users, $rmArr);
                }

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

        $maxChatId = Chatting::selectRaw('MAX(id) as maxId')->get()
            ->first()->maxId;


        $likes = Like::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20)->sortBy('created_at')->pluck('chatting_id');

        $popularChats = Chatting::where('channel_id', $channelId)
            ->has('likes')
            ->with('likes')->withCount('likes')
            ->with('user')
            ->orderBy('likes_count', 'desc')
            ->get();

        $ssuls = Ssul::with('channels')->with('teams')->get();

        $thisChannel = Channel::with('ssul.teams')->with('ssul.channels')->findOrFail($channelId);

        $teamACount = $ssul->teams[0]->chattings()
            ->join("likes", "likes.chatting_id", "chattings.id")->count();
        $teamBCount = $ssul->teams[1]->chattings()
            ->join("likes", "likes.chatting_id", "chattings.id")->count();

        if (($teamACount + $teamBCount) != 0) {
            $teamAPower = round($teamACount / ($teamACount + $teamBCount) * 100);
            $teamBPower = round($teamBCount / ($teamACount + $teamBCount) * 100);
        } else {
            $teamAPower = $teamACount;
            $teamBPower = $teamBCount;
        }


        return view('chatting', compact('ssuls', 'chats', 'thisChannel', 'popularChats', 'likes', 'user', 'loginMembers', 'myTeam', 'teamAPower', 'teamBPower', 'maxChatId'));
    }

    public function teamSelect(Request $request)
    {
        Session::put('myTeam', $request->teamSelect);
        return redirect()->back();
    }

    public function chatContent($channelId, $id)
    {
        $chats = Chatting::where('channel_id', $channelId)
            ->where('id', '<', $id)
            ->with('user')
            ->with('likes')
            ->orderBy('created_at')
            ->limit(20)->get()
            ->each(function (Chatting $chat) {
                if ($chat->likes->pluck('user_id')->contains(Auth::user()->id)) {
                    $chat->myLike = true;
                } else {
                    $chat->myLike = false;
                }
            });

        return $chats;
    }

}
