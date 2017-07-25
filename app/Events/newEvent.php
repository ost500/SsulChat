<?php

namespace App\Events;

use App\Chatting;
use App\Notifications\ChattingLog;
use App\SsulChatting;
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
use Illuminate\Support\Facades\Notification;

class newEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userName;
    public $time;
    public $ipAddress;
    public $chattingId;
    public $channelId;
    public $profile_img;
    public $chatResult;
    public $ssulId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->ssulId = $request->ssul_id;

        $this->message = $request->message;
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }
//        Notification::send(Auth::user(), new ChattingLog("{$this->userName}({$this->time}) : {$this->message}"));

        $this->ipAddress = $request->ipaddress;
        if (Auth::user()->name == "anonymous") {
            $this->userName = $request->anony_name;

        } else {
            $this->userName = Auth::user()->name;

        }
        $this->profile_img = Auth::user()->profile_img;

        $this->time = Carbon::now()->toDateTimeString();


        $chat = new Chatting();
        $chat->content = $this->message;
        $chat->user_id = Auth::user()->id;
        $chat->ipaddress = $this->ipAddress;
        $chat->team_id = $request->myTeam;
        $chat->save();

        $newSsulChatting = new SsulChatting();
        $newSsulChatting->ssul_id = $request->ssul_id;
        $newSsulChatting->chatting_id = $chat->id;
        $newSsulChatting->save();


        $this->chatResult = $chat;


        $this->chattingId = $chat->id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Notification::send(Auth::user(), new ChattingLog("[채널:{$this->channelId}]{$this->userName}({$this->time}) : {$this->message}"));

        return new PresenceChannel('newMessage' . $this->ssulId);
    }

    public function broadcastAs()
    {
        return 'testing';
    }

    public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        return [
            "id" => $this->chatResult->id,
            "team_id" => $this->chatResult->team_id,
            "user" => [
                "profile_img" => $this->chatResult->user->profile_img,
                "name" => $this->chatResult->user->name,
            ],

            "created_at" => $this->chatResult->created_at->toDateTimeString(),
            "ipaddress" => $this->chatResult->ipaddress,
            "content" => $this->chatResult->content,
            "likes" => [

            ]
        ];
    }
}
