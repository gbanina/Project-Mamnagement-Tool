<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
Use Redirect;
use App\User;
use App\Models\Status;
use App\Models\Priority;
use App\Models\TaskType;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttribute;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\PMTypesHelper;
use Illuminate\Http\Request;

class TaskController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('task.index')->with('tasks', Task::all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $typeId = $request->input('type');
        $projectId = $request->input('p');

        $projects = Project::all()->pluck('name', 'id')->prepend('Choose project', '');
        $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
        $status = Status::all()->pluck('name', 'id')->prepend('Choose status', '');
        $priorities = Priority::all()->pluck('label', 'id')->prepend('Choose priority', '');
        $types = TaskType::all()->pluck('name', 'id')->prepend('Choose type', '');

        return View::make('task.create')->with('projects', $projects)->with('projectId', $projectId)
                                            ->with('users',$users)->with('status',$status)
                                                    ->with('priorities',$priorities)
                                                        ->with('types',$types)->with('typeId',$typeId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'project' => 'required',
            'name' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if (false && $validator->fails()) {
            return redirect('task/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $task = new Task;
        $task->name = Input::get('name');
        $task->projects_id = Input::get('project_id');
        $task->task_types_id = Input::get('type_id');
        $task->responsible_id = Input::get('responsible_id');
        $task->status_id = Input::get('status_id');
        $task->priority_id = Input::get('priority_id');
        $task->description = Input::get('description');
        $task->archived = 'NO';
        $task->created_by = Auth::user()->id;

        $task->estimated_start_date = PMTypesHelper::dateToSQL(Input::get('estimated_start_date'));
        $task->estimated_end_date = PMTypesHelper::dateToSQL(Input::get('estimated_end_date'));
        $task->estimated_cost = Input::get('estimated_cost');

        $task->save();

        return Redirect::to('task/' . $task->id . '/edit');
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
        $projects = Project::all()->pluck('name', 'id')->prepend('Choose project', '');
        $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
        $status = Status::all()->pluck('name', 'id')->prepend('Choose status', '');
        $priorities = Priority::all()->pluck('label', 'id')->prepend('Choose priority', '');
        $task = Task::find($id);
        $types = $task->possibleTypes()->pluck('name', 'id')->prepend('Choose type', '');
        $fields = array();
        // Todo : refactor this
        foreach($task->taskType()->first()->fields() as $field){
            $att = TaskAttribute::where('task_id', $id)->where('task_fields_id', $field->id)->first();
            $val = '';
            if($att != null) $val = $att->value;
            $fields[$field->id] = array('type' => $field->type,
                                            'label' => $field->label,
                                                'value' => $val);
        }
        return View::make('task.edit')->with('projects',$projects)
                        ->with('users',$users)->with('status',$status)
                            ->with('priorities',$priorities)->with('types',$types)
                                ->with('task',$task)->with('fields',$fields);
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
            'project' => 'required',
            'name' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if (false && $validator->fails()) {
            return redirect('task/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $task = Task::find($id);
        $task->name = Input::get('name');
        /* project and type cannot chainge here */
        //$task->projects_id = Input::get('project_id');
        $task->task_types_id = Input::get('type_id');
        $task->responsible_id = Input::get('responsible_id');
        $task->status_id = Input::get('status_id');
        $task->priority_id = Input::get('priority_id');
        $task->description = Input::get('description');
        $task->archived = 'NO';

        $task->estimated_start_date = PMTypesHelper::dateToSQL(Input::get('estimated_start_date'));
        $task->estimated_end_date = PMTypesHelper::dateToSQL(Input::get('estimated_end_date'));
        $task->estimated_cost = Input::get('estimated_cost');

        $task->update();
        TaskAttribute::where('task_id', $task->id)->delete();
        if(Input::get('additional') !== null){
            foreach (Input::get('additional') as $key=>$att){
                TaskAttribute::create(['task_id' => $task->id, 'task_fields_id' => $key, 'value' => $att]);
            }
        }
        return Redirect::to('task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $task = Task::find($id);
        $task->delete();
        return Redirect::to('task');
    }
}
