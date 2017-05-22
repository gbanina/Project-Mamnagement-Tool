<?php

namespace App\Http\Controllers\User;

use Auth;
use View;
Use Redirect;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Invite;
use App\Models\UserAccounts;

class InviteController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function accept($hash)
    {
        $email = Auth::user()->email;
        $invite = Invite::where('email', $email)->where('hash', $hash)->first();
        if($invite == null) {
            // Forbidden
            App::abort(403, 'Wrong invitation code ...');
        } else {
            $accID = $invite->account_id;

            UserAccounts::create(['user_id' => Auth::user()->id,
                        'account_id' => $accID,
                        'role_id' => $invite->role_id,
                        'type' => 'MEMBER']);

            $invite->delete();

            return Redirect::to('/switch/' . $accID);
        }

        return Redirect::to('/');
    }
    public function decline($hash)
    {
        $email = Auth::user()->email;
        $invite = Invite::where('email', $email)->where('hash', $hash)->first();
        if($invite == null) {
            // Forbidden
            App::abort(403, 'Wrong invitation code ...');
        } else {
            $accID = $invite->status = 'Decline';
            $invite->save();
        }

        return Redirect::to('/');
    }
}
