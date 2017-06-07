<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Chatting
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $like
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Chatting extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function channel()
    {
        return  $this->belongsTo(Channel::class);
    }
}
