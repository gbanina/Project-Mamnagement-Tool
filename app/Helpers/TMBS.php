<?php
namespace App\Helpers;

use URL;
use App\Models\UserAccounts;

class TMBS{
    public static function url($url)
    {
        $account = auth()->user()->current_acc;
        return URL::to($account . '/' . $url);
    }
    public static function acc()
    {
        return auth()->user()->current_acc;
    }
    public static function isOwner()
    {
        $account = UserAccounts::where('user_id', auth()->user()->id)
                                ->where('account_id', auth()->user()->current_acc)->first();
        if($account != null) {
            if($account->type == 'OWNER') {
                return true;
            }
        }

        return false;
    }
}
