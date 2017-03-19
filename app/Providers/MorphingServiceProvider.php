<?php

namespace App\Providers;

use Auth;
use App\Models\Morphing;
use Illuminate\Support\ServiceProvider;

class MorphingServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function create()
    {
        $userAcc = Auth::user()->userAccount();
        if($userAcc->type != 'MORPH') {
            $morph = Morphing::create(['user_account_id' => $userAcc->id,
                                        'role_id' => $userAcc->role_id,
                                        'type' => $userAcc->type]);
        }else{
            $morph = Morphing::where('user_account_id', $userAcc->id)->first();
        }

        return $morph->id;
    }

    public function apply($roleId)
    {
        $userAcc = Auth::user()->userAccount();
        $userAcc->role_id = $roleId;
        $userAcc->type = 'MORPH';
        $userAcc->update();
    }

    public function return()
    {
        $userAcc = Auth::user()->userAccount();
        $morph = Morphing::where('user_account_id', $userAcc->id);
        $morph = $morph->first();
        if($morph != null){
            $userAcc->role_id = $morph->role_id;
            $userAcc->type = $morph->type;
            $userAcc->update();
            $morph->delete();
            return true;
        }
        return false;
    }
}
