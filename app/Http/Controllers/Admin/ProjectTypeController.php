<?php

namespace App\Http\Controllers\Admin;

use View;
use Redirect;
use App\Providers\Admin\ProjectTypeServiceProvider;
use App\Models\ProjectTypes;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectType;

class ProjectTypeController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->middleware('admin_access');
        $this->service = new ProjectTypeServiceProvider();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('admin.project-type.index')->with('projectTypes', $this->service->all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $view = View::make('admin.project-type.create')
                        ->with('hasTaskType', array())
                            ->with('taskTypes', $this->service->getTaskTypes());
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($account, StoreProjectType $request)
    {
        $this->service->store(Input::all());
        $request->session()->flash('alert-success', 'Project Type was successfuly created!');

        return Redirect::to($account . '/admin/project-type');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($account, $id)
    {
        $fields = $this->service->edit($id);
        $view = View::make('admin.project-type.edit')->with('projectType', $fields['projectTypes'])
                    ->with('taskTypes', $fields['taskTypes'])->with('hasTaskType', $fields['hasTaskType']);

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($account, $id, StoreProjectType $request)
    {
        $this->service->update($id, Input::all());
        $request->session()->flash('alert-success', 'Project Type was successfuly updated!');

        return Redirect::to($account . '/admin/project-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($account, $id, Request $request)
    {
        $type = ProjectTypes::find($id);
        $type->delete();
        $request->session()->flash('alert-success', 'Project Type was successfuly deleted!');

        return Redirect::to($account . '/admin/project-type');
    }
}
