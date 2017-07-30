<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function ssuls()
    {
        return $this->hasMany(PageSsul::class);
    }
}
