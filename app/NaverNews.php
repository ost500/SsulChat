<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\NaverNews
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $ssul_id
 * @property string $title
 * @property string $link
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $applied
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereApplied($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereSsulId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\NaverNews whereUpdatedAt($value)
 */
class NaverNews extends Model
{
    //
}
