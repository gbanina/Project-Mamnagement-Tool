<?php

namespace App\Providers\Admin;

use DB;
use Auth;
use App\User;
use App\Models\UserAccounts;
use Illuminate\Support\ServiceProvider;

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
}
