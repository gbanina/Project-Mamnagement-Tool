<?php

namespace App\Http\Controllers;

use DB;
use View;
use Redirect;
use Session;
use Auth;
use App\User;
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
        $users = UserAccounts::where('account_id', Auth::user()->current_acc)->with('user')->get();
        return $view->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return View::make('account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $request->session()->flash('alert-success', 'Account : '.''.' was successful created!');
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $request->session()->flash('alert-success', 'Account : '.''.' was successful updated!');
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
        $request->session()->flash('alert-success', 'Account : '.''.' was successful deleted!');
        return Redirect::to('account');
    }

}
