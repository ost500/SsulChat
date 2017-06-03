<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Like
 *
 * @property-read \App\Chatting $chatting
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Like extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chatting()
    {
        return $this->belongsTo(Chatting::class);
    }
}
