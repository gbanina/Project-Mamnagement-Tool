<?php

namespace App\Http\Controllers\User;

use DB;
use Auth;
use View;
Use Redirect;
use App\User;
use App\Models\Role;
use App\Models\UserAccounts;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Providers\Admin\UserServiceProvider;
use Illuminate\Http\Request;

class UsersController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->service = new UserServiceProvider();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('users.index');
        $users = UserAccounts::where('account_id', Auth::user()->current_acc)->with('user')->get();
        return $view->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::where('account_id', Auth::user()->current_acc)->pluck('name', 'id');
        return View::make('users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($account)
    {
        $this->service->inviteUser(Input::get('email'), Input::get('name'), Input::get('role_id'));
        return Redirect::to($account . '/users');
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
    public function edit($account, $id)
    {
        $usrAccount = UserAccounts::find($id);
        $roles = Role::where('account_id', $usrAccount->account_id)->pluck('name', 'id');
        $types = array(/*'OWNER' => 'Owner', */'ADMIN' => 'Admin', 'MEMBER' => 'Member');

        return View::make('users.edit')->with('account', $usrAccount)
                        ->with('roles', $roles)->with('types', $types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($account, $id, Request $request)
    {

        $usrAcount = UserAccounts::find($id);
        $usrAcount->role_id = Input::get('role_id');
        $usrAcount->type = Input::get('type');
        $usrAcount->save();

        $request->session()->flash('alert-success', 'User account was successful updated!');
        return Redirect::to($account . '/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($account, $id, Request $request)
    {
        $account = UserAccounts::find($id);
        $account->delete();

        $request->session()->flash('alert-success', 'User was successful deleted!');
        return Redirect::to($account . '/users');
    }

}
