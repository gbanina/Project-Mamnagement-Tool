<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
use Auth;
use Redirect;
use App\Providers\Admin\ProjectTypeServiceProvider;
use App\Models\ProjectTypes;
use App\Models\TaskType;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $rules = array(
            'type-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        $this->service->store(Input::all());
        $request->session()->flash('alert-success', 'Project Type was successfuly created!');

        return Redirect::to('admin/project-type');
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
    public function update($id, Request $request)
    {
        $rules = array(
            'type-label' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        $this->service->update($id, Input::all());

        $request->session()->flash('alert-success', 'Project Type was successfuly updated!');

        return Redirect::to('admin/project-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $type = ProjectTypes::find($id);
        $type->delete();
        $request->session()->flash('alert-success', 'Project Type was successfuly deleted!');

        return Redirect::to('admin/project-type');
    }

}
