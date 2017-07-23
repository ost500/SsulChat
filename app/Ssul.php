<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ssul
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Channel[] $channel
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Channel[] $channels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Ssul whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ssul whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ssul whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ssul whereUpdatedAt($value)
 */
class Ssul extends Model
{
    //
    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
