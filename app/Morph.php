<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Morph
 *
 * @property int $id
 * @property int $ssul_id
 * @property string $morph
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Morph whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Morph whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Morph whereMorph($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Morph whereSsulId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Morph whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Morph extends Model
{
    //
}
