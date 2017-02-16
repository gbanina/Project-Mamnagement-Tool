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
        return $this->belongsToMany('App\Models\Account', 'user_accounts');
    }
    public function getCurrentTeamAttribute()
    {
        //$all = $this->belongsToMany('App\Models\Account', 'user_accounts');
        //return $all->where('account_id','=',1)->first();
        return $this->belongsToMany('App\Models\Account', 'user_accounts');
    }

}

