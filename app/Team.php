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
 * @property int $id
 * @property int $ssul_id
 * @property string $name
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereSsulId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereValue($value)
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
