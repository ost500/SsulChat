<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TeamUser
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TeamUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamUser whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TeamUser whereUserId($value)
 */
class TeamUser extends Model
{

}
