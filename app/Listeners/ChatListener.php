<?php

namespace App\Listeners;
use App;
use App\Events\ChatEvent;
use BrainSocket\BrainSocketAppResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Auth;
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


        event(new ChatEvent("hi"));
        if ($data->data->name == null)
        {
            return $brain->message("receive.message", [
                'name' => $data->data->ip,
                'message' => $data->data->message,
            ]);
        } else {
            return $brain->message("receive.message", [
                'name' => $data->data->name,
                'message' => $data->data->message,
            ]);
        }
    }
}
