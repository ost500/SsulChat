<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property-read \App\Ssul $channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Chatting[] $chattings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @mixin \Eloquent
 */
class Team extends Model
{
    public function channel()
    {
        return $this->belongsTo(Ssul::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_users');
    }

    public function chattings()
    {
        return $this->hasMany(Chatting::class);
    }
}
