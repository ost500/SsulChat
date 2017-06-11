<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;


Broadcast::channel('App.User.*', function ($user, $id) {
//    return (int) $user->id === (int) $id;
    Log::info("here1!!!!!!!!!!!!!!!!");
    return true;
});

Broadcast::channel('channel-name', function ($user) {
    Log::info("here3!!!!!!!!!!!!!!!!");
    return true;
});
Broadcast::channel('presence-abc', function ($user) {
    Log::info("here3!!!!!!!!!!!!!!!!");
    return [
        'id' => $user->id,
        'name' => $user->name
    ];
});

Broadcast::channel('abc', function () {
    Log::info("here3!!!!!!!!!!!!!!!!");
    return true;
});
Broadcast::channel('try', function ($user) {
    Log::info("try!!!!!!!!!!!!!!!!");
    return true;
});
Broadcast::channel('presence-try', function () {
    Log::info("try!!!!!!!!!!!!!!!!");
    return true;
});
Broadcast::channel('newMessage*', function () {
    Log::info("new Message!");
    return true;
});
Broadcast::channel('like', function () {
    Log::info("try!!!!!!!!!!!!!!!!");
    return true;
});