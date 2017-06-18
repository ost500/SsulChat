<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function channel()
    {
        return $this->belongsTo(Ssul::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
