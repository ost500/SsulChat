<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ssul
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Channel[] $channel
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Channel[] $channels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 */
class Ssul extends Model
{
    //
    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
