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
    public function accounts()
    {
        return $this->belongsToMany('App\Models\Account', 'user_accounts');
    }

    public function currentacc()
    {
        return $this->belongsTo('App\Models\Account', 'current_acc');
    }

    public function getCurrentTeamAttribute()
    {
        return $this->belongsToMany('App\Models\Account', 'user_accounts');
    }

    public function switchAccount($user, $acc){
        $this->current_acc = $acc;
        $this->update();
    }
}
