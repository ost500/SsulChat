<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Instagram
 *
 * @property int $id
 * @property int $ssul_id
 * @property string $display_src
 * @property string $date
 * @property string $caption
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $applied
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereApplied($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereCaption($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereDisplaySrc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereSsulId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Instagram whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Instagram extends Model
{
    //
}
