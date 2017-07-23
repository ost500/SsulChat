<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Like
 *
 * @property-read \App\Chatting $chatting
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $chatting_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereChattingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereUserId($value)
 */
class Like extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chatting()
    {
        return $this->belongsTo(Chatting::class);
    }
}
