<?php

namespace App\Http\Controllers\Admin;

use View;
Use Redirect;
use App\Models\Status;
use Session;
use App\Http\Requests\StoreStatus;
use App\Providers\Admin\TaskStatusServiceProvider;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StatusController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->middleware('admin_access');
        $this->service = new TaskStatusServiceProvider();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('admin.status.index')->with('statuses', $this->service->all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreStatus $request)
    {
        $status = $this->service->store(Input::all());
        $request->session()->flash('alert-success', 'Status : '. $status->name .' was successful created!');
        return Redirect::to('admin/status');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view = View::make('admin.status.edit')->with('status', $this->service->getStatus($id));
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StoreStatus $request)
    {
        $status = $this->service->update($id, Input::all());
        $request->session()->flash('alert-success', 'Status : '.$status->name.' was successful updated!');
        return Redirect::to('admin/status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $this->service->destroy($id);
        $request->session()->flash('alert-success', 'Status was successful deleted!');
        return Redirect::to('admin/status');
    }
}
