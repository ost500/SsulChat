<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ssul
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Channel[] $channel
 * @mixin \Eloquent
 */
class Ssul extends Model
{
    //
    public function channel()
    {
        return $this->hasMany(Channel::class);
    }
}
