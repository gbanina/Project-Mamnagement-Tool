<?php

namespace App\Http\Controllers\Admin;

use Auth;
use View;
use Redirect;
use App\Models\Role;
use App\Http\Requests\StoreRole;
use App\Providers\Admin\RoleServiceProvider;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class RoleController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->middleware('admin_access');
        $this->service = new RoleServiceProvider();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       return View::make('admin.role.index')->with('roles', $this->service->all());
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
    public function store(StoreRole $request)
    {
        $this->service->store(Input::get('role-name'));
        $request->session()->flash('alert-success', 'New role successfuly created!');
        return Redirect::to('admin/role');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view = View::make('admin.role.edit')->with('role', $this->service->find($id));
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StoreRole $request)
    {
        $this->service->update($id, Input::get('role-name'));
        $request->session()->flash('alert-success', 'Role successfuly updated!');
        return Redirect::to('admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $this->service->delete($id);
        $request->session()->flash('alert-success', 'Role successfuly deleted!');
        return Redirect::to('admin/role');
    }
}
