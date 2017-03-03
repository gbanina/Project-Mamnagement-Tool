<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\TaskType;
use App\Models\TaskField;
use App\Providers\Admin\TaskTypeServiceProvider;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TaskTypeController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->service = new TaskTypeServiceProvider();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('admin.task-type.index')->with('taskTypes', $this->service->all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.task-type.create')
            ->with('taskFields', $this->service->create())->with('hasTaskField', array());
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
        $request->session()->flash('alert-success', 'Task Type was successfuly created!');
        return Redirect::to('admin/task-type');
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

        $view = View::make('admin.task-type.edit')
                        ->with('taskType', $fields['taskType'])
                            ->with('taskFields', $fields['taskFields'])
                                ->with('hasTaskField', $fields['taskType']->hasTaskField());
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
            'type-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
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
