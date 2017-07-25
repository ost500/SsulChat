<?php

namespace App\Events;

use App\Chatting;
use App\Http\Controllers\ChattingController;
use App\Like;
use App\Notifications\ChattingLog;
use App\Ssul;
use App\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Psy\Util\Json;

class likeEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $time;
    public $chattingId;
    public $available;
    public $popularChats;
    public $ssulId;
    public $teamsPower;
    public $like;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }
        //Notification::send(User::first(), new ChattingLog("{$this->userName}({$this->time}) : {$this->message}"));

        $this->userId = Auth::user()->id;
        $this->time = Carbon::now()->toDateTimeString();
        $this->chattingId = $request->chattingId;
        $this->ssulId = $request->ssul_id;


        // 좋아요 카운트 반환

        $old = DB::table('likes')->where('chatting_id', $this->chattingId)->where('user_id', $this->userId)->first();
        if ($old) {
            DB::table('likes')->where('chatting_id', $this->chattingId)->where('user_id', $this->userId)->delete();
            $this->available = false;
        } else {
            $this->like = new Like();
            $this->like->chatting_id = $this->chattingId;
            $this->like->user_id = Auth::user()->id;
            $this->like->save();

            $this->available = true;
        }
        $popularChats = Chatting::join('ssul_chattings', 'chattings.id', '=', 'ssul_chattings.chatting_id')
            ->where('ssul_chattings.ssul_id', $this->ssulId)
            ->has('likes')
            ->with('likes')->withCount('likes')
            ->with('user')
            ->orderBy('likes_count', 'desc')
            ->get();

        $this->popularChats = Array();
        for ($i = 0; $i < $popularChats->count(); $i++) {
            $array = Array();
            $array = array_add($array, 'user_name', $popularChats[$i]->user->name);
            $array = array_add($array, 'likes_count', $popularChats[$i]->likes_count);
            $array = array_add($array, 'content', $popularChats[$i]->content);
            $array = array_add($array, 'user_profile_img', $popularChats[$i]->user->profile_img);
            $this->popularChats = array_add($this->popularChats, $i, $array);
        }

        $teamsPowerCount = Team::where('ssul_id', $this->ssulId)
            ->join('chattings', 'chattings.team_id', 'teams.id')
            ->join("likes", "likes.chatting_id", "chattings.id")
            ->groupBy('teams.id')
            ->selectRaw('count(likes.id) as count')
            ->get()->map(function ($team) {
                return $team->count;
            })->toArray();

        if (!isset($teamsPowerCount[0]) && !isset($teamsPowerCount[1])) {
            $teamsPowerCount[0] = 1;
            $teamsPowerCount[1] = 1;
        } elseif (!isset($teamsPowerCount[0])) {
            $teamsPowerCount[0] = 1;
        } elseif (!isset($teamsPowerCount[1])) {
            $teamsPowerCount[1] = 1;
        }

        $this->teamsPower[0] = round($teamsPowerCount[0] / ($teamsPowerCount[0] + $teamsPowerCount[1]) * 100, 0);
        $this->teamsPower[1] = 100 - $this->teamsPower[0];


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        //Notification::send(User::first(), new ChattingLog("{$this->userName}({$this->time}) : {$this->message}"));

        return new PresenceChannel('newMessage' . $this->ssulId);
    }

    public function broadcastAs()
    {
        return 'like';
    }

    public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        return [
            'chattingId' => $this->chattingId,
            'userId' => $this->userId,
            'available' => $this->available,
            'popularChats' => $this->popularChats,
            'teamsPower' => $this->teamsPower,
            'like' => $this->like
        ];
    }
}
