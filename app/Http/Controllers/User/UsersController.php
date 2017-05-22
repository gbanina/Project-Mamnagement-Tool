<?php

namespace App\Http\Controllers;

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
    public function store()
    {
        $this->service->inviteUser(Input::get('email'), Input::get('name'), Input::get('role_id'));
        return Redirect::to('users');
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

        return View::make('users.edit')->with('account', $account)
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

        $request->session()->flash('alert-success', 'User account was successful updated!');
        return Redirect::to('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}
