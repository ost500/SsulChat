<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagePost extends Model
{
    public function pagePostPictures()
    {
        return $this->hasMany(PagePostPicture::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
