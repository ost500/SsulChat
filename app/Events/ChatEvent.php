<?php

namespace App\Events;

use App\Chatting;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $message)
    {
        $chat = new Chatting();
        $chat->content = $message;
        $chat->ipadress = 123;
        $chat->user_id = 1;
        $chat->save();

        $user = User::find(1);
        $this->user = $user;

        $this->data = array('power' => 10);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-name');
    }

    public function broadcastAs()
    {
        return 'server.created';
    }
}
