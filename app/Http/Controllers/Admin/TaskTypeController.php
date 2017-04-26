<?php

namespace App\Http\Controllers\Admin;

use View;
Use Redirect;
use App\Models\TaskType;
use App\Models\TaskField;
use App\Providers\Admin\TaskTypeServiceProvider;
use App\Providers\Admin\TaskViewServiceProvider;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskType;

class TaskTypeController extends BaseController {

    protected $service;
    protected $viewService;

    public function __construct()
    {
        $this->middleware('admin_access');
        $this->service      = new TaskTypeServiceProvider();
        $this->viewService  = new TaskViewServiceProvider();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('admin.task-type.index')->with('taskTypes', $this->service->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $fields = $this->service->create();
        $taskViews = $this->viewService->all()->pluck('name', 'id')->prepend('Choose type', '');
        return View::make('admin.task-type.create')
            ->with('taskFields', $fields['taskFields'])->with('hasTaskField', array())
            ->with('projectTypes', $fields['projectTypes'])->with('hasProjectType', array())
                ->with('taskViews', $taskViews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreTaskType $request)
    {
        $this->service->store(Input::all());
        $request->session()->flash('alert-success', 'Task Type was successfuly created!');
        return Redirect::to('admin/task-type');
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
        $taskViews = $this->viewService->all()->pluck('name', 'id')->prepend('Choose type', '');
        return View::make('admin.task-type.edit')->with('taskType', $fields['taskType'])
                    ->with('taskFields', $fields['taskFields'])->with('hasTaskField', $fields['taskType']->hasTaskField())
                        ->with('projectTypes', $fields['projectTypes'])->with('hasProjectType', $fields['taskType']->hasProjectType())
                            ->with('taskViews', $taskViews);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StoreTaskType $request)
    {
        $this->service->update($id, Input::all());
        $request->session()->flash('alert-success', 'Task Type was successfuly updated!');
        return Redirect::to('admin/task-type');
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
        $request->session()->flash('alert-success', 'Task Type was successfuly deleted!');
        return Redirect::to('admin/task-type');
    }
}
