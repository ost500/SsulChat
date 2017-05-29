<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ssul extends Model
{
    //
    public function channel()
    {
        return $this->hasMany(Channel::class);
    }
}
