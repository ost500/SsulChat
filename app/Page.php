<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function ssuls()
    {
        return $this->belongsToMany(Ssul::class, 'page_ssuls');
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'admins');
    }

    public function pagePosts()
    {
        return $this->hasMany(PagePost::class);
    }
}
