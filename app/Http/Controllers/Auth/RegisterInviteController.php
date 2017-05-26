<?php

namespace App\Http\Controllers\Auth;

use DB;
use View;
use Auth;
Use Redirect;
use Session;
use App\Models\Invite;
use App\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Providers\PredefinedDataServiceProvider;
use App\Models\UserAccounts;

class RegisterInviteController extends BaseController {

    public function show($hash, Request $request)
    {
        $invite = Invite::where('hash', $hash)->first();
        if($invite == null) {
            // Forbidden
            App::abort(403, 'Wrong invitation code ...');
        } else {
            return View::make('auth.register-invite')->with('hash', $hash)
                    ->with('email', $invite->email)->with('name', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function store(Request $request)
    {
        $invite = Invite::where('hash', Input::get('hash'))->first();

        $user = User::create([
            'name' => Input::get('name'),
            'email' => $invite->email,
            'password' => bcrypt(Input::get('password')),
            'confirmed' => 1,
        ]);

        $userAcc = UserAccounts::create(['user_id' => $user->id,
                                            'account_id' => $invite->account_id,
                                            'role_id' => $invite->role_id,
                                            'type' => 'MEMBER']);

        $populateDataService = new PredefinedDataServiceProvider($user->id, $user->name, $invite->account_id);

        Auth::loginUsingId($user->id);

        return Redirect::to('/');
    }
}
