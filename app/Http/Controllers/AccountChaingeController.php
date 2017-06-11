<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
use Redirect;
use App\Models\UserAccounts;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Providers\Admin\AccountService;

class AccountChaingeController extends BaseController {

    public function switchTo($account, $id)
    {
        $accountService = new AccountService();
        $accountService->switch($id);

        return Redirect::to($id . '/board');
    }
}
