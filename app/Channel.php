<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Channel
 *
 * @property-read \App\Ssul $ssul
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Chatting[] $chattings
 */
class Channel extends Model
{

    public function ssul()
    {
        return $this->belongsTo(Ssul::class);
    }

    public function chattings()
    {
        return $this->hasMany(Chatting::class);
    }


}
