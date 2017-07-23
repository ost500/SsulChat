<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Chatting;
use App\Like;
use App\Morph;
use App\Ssul;
use App\User;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;


class ChattingController extends Controller
{
    use SEOTools;

    public function chattings(Request $request, $id, $channelId = 0)
    {

        $ssul = Ssul::find($id);

        /** @var Collection $morphs */
        $morphs = Morph::where('ssul_id', $id)
            ->orderBy('count', 'desc')->take(10)->pluck('morph');

        $this->seo()->setTitle($ssul->name);
        SEOMeta::addKeyword($morphs->toArray());


        if ($channelId == 0) {

            $channelId = $ssul->channels->first()->id;
        }

        $myPrevChat = $request->session()->get('myPrevChat');

        Session::put('myPrevChat', $ssul->id);


        // 새로고침한 경우
        if ($myPrevChat == $ssul->id) {

            $user = Auth::user();

        } else {


            $loginMembers = null;


            // 로그인 안 됐다면 또는 익명이라면
            if (!Auth::check() || Auth::user()->annony) {

                $loginMembers = Redis::get("presence-newMessage{$channelId}:members");

                $loginMembers = json_decode($loginMembers);


                $users = User::where('annony', true)->orderby('updated_at')->pluck('id');
                $users = $users->toArray();

                // 로그인 유저
                $user = null;


                // 로그인 된 익명들 제외
                if (!is_null($loginMembers)) {
                    foreach ($loginMembers as $member) {
                        $rmArr = array($member->user_info->id);
                        $users = array_diff($users, $rmArr);
                    }

                }

                $users = array_values($users);


                // 익명 로그인을 했고
                // 로그인 명단에 익명 이 있다면 로그아웃 후 다른 이름으로 로그인
                // 없다면 로그아웃 없이 그대로 진행
                if ($user == null && Auth::check() && Auth::user()->annony && !in_array(Auth::user()->id, $users)) {
                    Auth::logout();
                } else {
                    $user = Auth::user();
                }


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
            $teamAPower = 50;
            $teamBPower = 50;
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
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->with('likes')
            ->limit(100)
            ->get()
            ->sortBy('id')->values()
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
