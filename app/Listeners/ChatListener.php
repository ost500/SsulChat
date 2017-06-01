<?php

namespace App\Listeners;

use App\Events\ChatEvent;
use BrainSocket\BrainSocketAppResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChatListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     */
    public function handle($data)
    {

        $brain = new BrainSocketAppResponse();


        event(new ChatEvent($data->data->name, $data->data->message));

        return $brain->message( "receive.message", [
            'name' => $data->data->name,
            'message' => $data->data->message,
        ]);

    }
}
