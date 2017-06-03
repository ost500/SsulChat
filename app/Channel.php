<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Channel
 *
 * @property-read \App\Ssul $ssul
 * @mixin \Eloquent
 */
class Channel extends Model
{
    public function ssul()
    {
        return $this->belongsTo(Ssul::class);
    }

}
