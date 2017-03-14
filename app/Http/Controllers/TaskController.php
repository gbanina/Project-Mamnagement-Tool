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
use App\Models\Dashboard;
use App\Models\Comment;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\PMTypesHelper;
use Illuminate\Http\Request;
use App\Providers\TaskServiceProvider;

class TaskController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sp = new TaskServiceProvider($this);
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
        $projectId = $request->input('p');

        $projectName = Project::find($projectId)->name;

        $projects = Project::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose project', '');
        $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
        $status = Status::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose status', '');
        $priorities = Priority::all()->where('account_id', Auth::user()->current_acc)->pluck('label', 'id')->prepend('Choose priority', '');
        $types = TaskType::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose type', '');

        return View::make('task.create')->with('projects', $projects)->with('projectId', $projectId)
                                            ->with('users',$users)->with('status',$status)
                                                    ->with('priorities',$priorities)
                                                        ->with('types',$types)
                                                            ->with('projectName',$projectName);
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
        $task->account_id = Auth::user()->current_acc;
        $task->name = Input::get('name');
        $task->projects_id = Input::get('project_id');
        $task->internal_id = Auth::user()->currentacc->nextTaskId();
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

        $board = new Dashboard;
        $board->account_id = Auth::user()->current_acc;
        $board->user_id = Auth::user()->id;
        $board->project_id = $task->projects_id;
        $board->title = "created a new " . $task->type; //getTypeAttribute
        $board->content = $task->internal_id . ':' . $task->name . ' - ' . $task->description;
        $board->save();

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
        $projects = Project::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose project', '');
        $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
        $status = Status::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose status', '');
        $priorities = Priority::all()->where('account_id', Auth::user()->current_acc)->pluck('label', 'id')->prepend('Choose priority', '');
        $types = TaskType::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose type', '');
        $task = Task::find($id);

        $comments = Comment::where('entity_id', $id)->where('entity_type', 'TASK')->orderBy('id', 'desc')->get();

        /* Required for work table */
        $tasks = Task::where('account_id', Auth::user()
                        ->current_acc)->where('responsible_id', Auth::user()->id)
                            ->pluck('name', 'id')->prepend('Choose task', '');

        $fields = array();
        // Todo : refactor this
        foreach($task->taskType()->first()->fields()->get() as $field){
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
                                ->with('task',$task)->with('fields',$fields)
                                    ->with('tasks', $tasks)->with('comments', $comments);
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
        //$task->task_types_id = Input::get('type_id');
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
