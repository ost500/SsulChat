<?php

namespace App\Events;

use App\Chatting;
use App\Notifications\ChattingLog;
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

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request)
    {
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
        $this->channelId = $request->channel_id;

        $chat = new Chatting();
        $chat->content = $this->message;
        $chat->channel_id = $request->channel_id;
        $chat->user_id = Auth::user()->id;
        $chat->ipaddress = $this->ipAddress;
        $chat->team_id = 1;
        $chat->save();

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

        return new PresenceChannel('newMessage' . $this->channelId);
    }

    public function broadcastAs()
    {
        return 'testing';
    }

    public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        return [
            'message' => $this->message,
            'userName' => $this->userName,
            'time' => $this->time,
            'ipAddress' => $this->ipAddress,
            'id' => $this->chattingId,
            'profile_img' => $this->profile_img
        ];
    }
}
