<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Chatting[] $chatting
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $like
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Chatting[] $chattings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[] $likes
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'annony', 'profile_img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function chattings()
    {
        return $this->hasMany(Chatting::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function routeNotificationFor()
    {
        return env('SLACK_WEBHOOK_URL');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_users');
    }
}
