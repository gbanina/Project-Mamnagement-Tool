<?php

namespace App\Http\Controllers;

use DB;
use View;
Use Redirect;
use App\User;
use App\Models\Status;
use App\Models\Priority;
use App\Models\TaskType;
use App\Models\Project;
use App\Models\Task;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\PMTypesHelper;

class TaskController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = Task::all();
        $view = View::make('task.index')->with('tasks', $tasks);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $projects = Project::all()->pluck('name', 'id')->prepend('Choose project', '');
        $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
        $status = Status::all()->pluck('name', 'id')->prepend('Choose status', '');
        $priorities = Priority::all()->pluck('label', 'id')->prepend('Choose priority', '');
        $types = TaskType::all()->pluck('name', 'id')->prepend('Choose type', '');

        return View::make('task.create')->with('projects',$projects)
                                            ->with('users',$users)
                                                ->with('status',$status)
                                                    ->with('priorities',$priorities)
                                                        ->with('types',$types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
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

        $task->estimated_start_date = PMTypesHelper::dateToSQL(Input::get('estimated_start_date'));
        $task->estimated_end_date = PMTypesHelper::dateToSQL(Input::get('estimated_end_date'));
        $task->estimated_cost = Input::get('estimated_cost');

        $task->save();

        return Redirect::to('task');
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
        $types = TaskType::all()->pluck('name', 'id')->prepend('Choose type', '');
        $task = Task::find($id);

        return View::make('task.edit')->with('projects',$projects)
                                            ->with('users',$users)
                                                ->with('status',$status)
                                                    ->with('priorities',$priorities)
                                                        ->with('types',$types)
                                                            ->with('task',$task);
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
        $task->projects_id = Input::get('project_id');
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

        return Redirect::to('task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return Redirect::to('task');
    }
}
