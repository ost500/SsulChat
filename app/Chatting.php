<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Chatting
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $like
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property-read \App\Channel $channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 * @property-read \App\Team $team
 * @property int $id
 * @property string $content
 * @property int $user_id
 * @property int $team_id
 * @property int $channel_id
 * @property string $ipaddress
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $picture
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereChannelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereIpaddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting wherePicture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Chatting whereUserId($value)
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
        return $this->belongsTo(Channel::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
