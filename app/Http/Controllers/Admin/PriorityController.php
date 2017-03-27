<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\Priority;
use App\Http\Requests\StorePriority;
use Session;
use App\Providers\Admin\TaskPriorityServiceProvider;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PriorityController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->middleware('admin_access');
        $this->service = new TaskPriorityServiceProvider();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('admin.priority.index')->with('priorities', $this->service->all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StorePriority $request)
    {
        $priority = $this->service->store(Input::all());
        $request->session()->flash('alert-success', 'Priority : '.$priority->label.' was successful created!');

        return Redirect::to('admin/priority');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view = View::make('admin.priority.edit')->with('priority', $this->service->getPriority($id));
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StorePriority $request)
    {
        $priority = $this->service->update($id, Input::all());
        $request->session()->flash('alert-success', 'Priority : '.$priority->label.' was successful updated!');

        return Redirect::to('admin/priority');
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
        $request->session()->flash('alert-success', 'Priority was successful deleted!');

        return Redirect::to('admin/priority');
    }
}
