<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use View;
use Redirect;
use App\Models\Role;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RoleController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::where('account_id', Auth::user()->current_acc)->get();
        $view = View::make('admin.role.index')->with('roles', $roles);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'role-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $role = new Role();
        $role->account_id = Auth::user()->current_acc;
        $role->name =Input::get('role-name');
        $role->save();

        return Redirect::to('admin/role');
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
        $role = Role::find($id);

        $view = View::make('admin.role.edit')->with('role', $role);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'role-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $role = Role::find($id);
        $role->name =Input::get('role-name');
        $role->save();

        return Redirect::to('admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return Redirect::to('admin/role');
    }

}
