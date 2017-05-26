<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hashtag()
    {
        return $this->belongsToMany(Hashtag::class);
    }
}