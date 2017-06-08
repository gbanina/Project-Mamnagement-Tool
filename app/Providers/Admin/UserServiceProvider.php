<?php

namespace App\Providers\Admin;

use DB;
use URL;
use Auth;
use Hash;
use App\User;
use App\Models\UserAccounts;
use App\Models\ProjectRight;
use App\Models\Invite;
use Illuminate\Support\ServiceProvider;
use App\Providers\EmailProvider;

class UserServiceProvider extends ServiceProvider
{
    public function __construct()
    { }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function all()
    {
        return UserAccounts::where('account_id', Auth::user()->current_acc)->with('user')->get();
    }
    public function selectList()
    {
        return DB::table('users')->join('user_accounts', 'users.id', '=', 'user_accounts.user_id')
        ->where('account_id', Auth::user()->current_acc)->pluck('name', 'user_id');
    }
    public function inviteUser($email, $name, $role)
    {
        $hash = Hash::make(time() . '_' . Auth::user()->current_acc);
        $hash = preg_replace('/[^A-Za-z0-9\-]/', '', $hash);

        $invite = new Invite();
        $invite->account_id = Auth::user()->current_acc;
        $invite->email = $email;
        $invite->hash = $hash;
        $invite->role_id = $role;
        $invite->save();

        $emailService = new EmailProvider();

        if(User::where('email', $email)->first() == null) {// User not exists
            $emailService->createAttribute($email, $name, URL::to('register-invite/' . $hash ));
        }else { // User Exists
            $emailService->createAttribute($email, $name, URL::to('invite/' . $hash ));
        }
    }
    public function getUsersWithAccess($projectId) {
        $allAccounts = UserAccounts::where('account_id', Auth::user()->current_acc)->get();
        $users = array();
        foreach($allAccounts as $account) {
            if($account->type == 'ADMIN' || $account->type == 'OWNER') {
                array_push($users, $account->user);
                continue;
            }
            $right = ProjectRight::where('role_id', $account->role_id)->where('project_id', $projectId)->first();
            if($right != null) {
                if($right->permission != 'NONE') {
                    array_push($users, $account->user);
                }
            }
        }
        return $users;
    }
}
