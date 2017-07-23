<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Channel
 *
 * @property-read \App\Ssul $ssul
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Chatting[] $chattings
 * @property int $id
 * @property string $name
 * @property int $ssul_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Channel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Channel whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Channel whereSsulId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Channel whereUpdatedAt($value)
 */
class Channel extends Model
{

    public function ssul()
    {
        return $this->belongsTo(Ssul::class);
    }

    public function chattings()
    {
        return $this->hasMany(Chatting::class);
    }


}
