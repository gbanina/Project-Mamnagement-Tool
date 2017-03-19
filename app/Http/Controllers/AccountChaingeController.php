<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
use Redirect;
use App\Models\UserAccounts;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AccountChaingeController extends BaseController {

    public function switchTo($id)
    {
        $user = Auth::user();
        //check if user has right to this acc
        $rel = UserAccounts::where('user_id', $user->id)->where('account_id', $id);
        if($rel->first() == null){
            abort(403, 'Unauthorized action.');
        }
        //switch account
        $user->switchAccount($user->id, $id);
        //redirect
        return Redirect::to('board'); // Redirect::back(); ?
    }
}
