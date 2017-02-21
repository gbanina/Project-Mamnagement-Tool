<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\TaskType;
use App\Models\TaskField;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TaskTypeController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tt = TaskType::all();
        $view = View::make('admin.task-type.index')->with('taskTypes', $tt);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $taskFields = TaskField::all();
        return View::make('admin.task-type.create')
            ->with('taskFields', $taskFields)->with('hasTaskField', array());
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

        $taskType = new TaskType();
        $taskType->accounts_id = 1;
        $taskType->name =Input::get('type-name');
        $taskType->save();
        $taskType->updateTaskFields(Input::get('task_field'));
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
        $taskType = TaskType::find($id);
        $taskFields = TaskField::all();

        $view = View::make('admin.task-type.edit')
                        ->with('taskType', $taskType)
                            ->with('taskFields', $taskFields)
                                ->with('hasTaskField', $taskType->hasTaskField());
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

        $taskType = TaskType::find($id);
        $taskType->name =Input::get('type-name');
        $taskType->save();
        $taskType->updateTaskFields(Input::get('task_field'));

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
        $type = TaskType::find($id);
        $type->delete();
        $request->session()->flash('alert-success', 'Task Type was successfuly deleted!');

        return Redirect::to('admin/task-type');
    }

}
