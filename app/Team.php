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
        return $this->belongsToMany(User::class, 'team_users');
    }
}
