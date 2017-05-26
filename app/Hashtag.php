<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    public function article()
    {
        return $this->belongsToMany(Article::class);
    }
}
