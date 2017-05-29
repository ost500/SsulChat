<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function ssul()
    {
        return $this->belongsTo(Ssul::class);
    }

}
