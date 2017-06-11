<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ssul
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Channel[] $channel
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Channel[] $channels
 */
class Ssul extends Model
{
    //
    public function channels()
    {
        return $this->hasMany(Channel::class);
    }
}
