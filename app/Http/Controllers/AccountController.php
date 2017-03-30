<?php

namespace App\Http\Controllers;

use DB;
use View;
use Redirect;
use Session;
use Auth;
use App\User;
use App\Models\Role;
use App\Models\Account;
use App\Models\UserAccounts;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AccountController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('account.index');
        foreach(Auth::user()->accounts as $acc)
            $users[$acc->id] = UserAccounts::where('account_id', $acc->id)->with('user')->get();

        return $view->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $accountId = $request->input('acc');
        $account = Account::find($accountId);

        return View::make('account.create')->with('account', $account);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'email' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);



        $request->session()->flash('alert-success', 'invitation has been sent to !');
        return Redirect::to('account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $account = UserAccounts::find($id);
        $roles = Role::where('account_id', $account->account_id)->pluck('name', 'id');
        $types = array(/*'OWNER' => 'Owner', */'ADMIN' => 'Admin', 'MEMBER' => 'Member');

        return View::make('account.edit')->with('account', $account)
                        ->with('roles', $roles)->with('types', $types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $account = UserAccounts::find($id);
        $account->role_id = Input::get('role_id');
        $account->type = Input::get('type');
        $account->save();

        $request->session()->flash('alert-success', 'Account : was successful updated!');
        return Redirect::to('account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $request->session()->flash('alert-success', 'Account : was successful deleted!');
        return Redirect::to('account');
    }

}
