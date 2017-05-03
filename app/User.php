<?php

namespace App;

use Auth;
use App\Models\UserAccounts;
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
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['currentTeam' => 'array'];

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

    public function userAccount()
    {
        return UserAccounts::where('account_id', $this->current_acc)
                        ->where('user_id', Auth::user()->id)->first();

        //return $this->belongsTo('App\Models\UserAccounts', 'current_acc')->first();
    }
    public function getCurrentRoleAttribute()
    {
        return UserAccounts::where('account_id', $this->current_acc)
                        ->where('user_id', Auth::user()->id)->first()->type;
    }
    public function currentRole()
    {
        $userAcc = UserAccounts::where('account_id', $this->current_acc)
                        ->where('user_id', Auth::user()->id)->first();

        return $userAcc->role();
    }

    public function isAdmin()
    {
        $accountType = $this->getCurrentRoleAttribute();

        if ($accountType == 'OWNER' || $accountType == 'ADMIN') {
            return true;
        }

        return false;
    }

    public function getCurrentTeamAttribute()
    {
        return $this->belongsToMany('App\Models\Account', 'user_accounts');
    }

    public function switchAccount($user, $acc){
        $this->current_acc = $acc;
        $this->update();
    }

    public function myTasks()
    {
        return $this->belongsToMany('App\Models\Task', 'user_tasks');
    }
}
