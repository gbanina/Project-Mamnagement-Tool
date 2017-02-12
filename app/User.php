<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  protected $casts = [
        'currentTeam' => 'array',
    ];

    /**
     * Get the organisational entities for the user.
     */
    public function organisations()
    {
        return $this->belongsToMany('App\Models\Organisation', 'user_organisations');
    }
    public function getCurrentTeamAttribute()
    {
        $all = $this->belongsToMany('App\Models\Organisation', 'user_organisations');
        return $all->where('owner_id','=',1)->first();
    }

}

