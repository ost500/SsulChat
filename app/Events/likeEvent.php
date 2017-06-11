<?php

namespace App\Events;

use App\Chatting;
use App\Like;
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

class likeEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $time;
    public $chattingId;
    public $channelId;
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
        $this->channelId = $request->channelId;

        $like = new Like();
        $like->chatting_id = $this->chattingId;
        $like->user_id = Auth::user()->id;
        $like->save();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        //Notification::send(User::first(), new ChattingLog("{$this->userName}({$this->time}) : {$this->message}"));

        return new PresenceChannel('newMessage' . $this->channelId);
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
        ];
    }
}
