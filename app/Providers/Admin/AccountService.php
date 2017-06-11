<?php

namespace App\Providers\Admin;

use Auth;
use App\Models\UserAccounts;
use Illuminate\Support\ServiceProvider;

class AccountService extends ServiceProvider
{
    public function __construct()
    { }

    public function switch($id)
    {
        $user = Auth::user();
        //check if user has right to this acc
        $rel = UserAccounts::where('user_id', $user->id)->where('account_id', $id);
        if($rel->first() == null){
            abort(403, 'Unauthorized action.');
        }
        //switch account
        $user->switchAccount($user->id, $id);
    }
}
