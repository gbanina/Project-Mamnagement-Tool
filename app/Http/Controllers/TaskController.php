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
use App\Models\FieldRight;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttribute;
use App\Models\Dashboard;
use App\Models\Comment;
use App\Models\UserTask;
use App\Http\Requests\StoreTask;
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
        $projects = Project::all()->where('account_id', Auth::user()->current_acc)
                                ->where('permission','!=', 'NONE')->pluck('name', 'id');
        $sp = new TaskServiceProvider($this);
        $tasks = Task::all()->where('account_id', Auth::user()->current_acc)->where('permission','!=', 'NONE');
        $view = View::make('task.index')->with('tasks', $tasks)->with('projects', $projects);
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
        $project = Project::find($projectId);
        $projectName = $project->name;
        if($project->getPermissionAttribute() != 'NONE' && $project->getPermissionAttribute() != 'READ'){
            $projects = Project::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose project', '');
            $usersO = User::all();
            $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
            $status = Status::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose status', '');
            $priorities = Priority::all()->where('account_id', Auth::user()->current_acc)->pluck('label', 'id')->prepend('Choose priority', '');
            $types = TaskType::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose type', '');

            return View::make('task.create')->with('projects', $projects)->with('projectId', $projectId)
                                                ->with('users',$users)->with('usersO',$usersO)->with('status',$status)
                                                        ->with('priorities',$priorities)
                                                            ->with('types',$types)
                                                                ->with('projectName',$projectName);
        }
        return Redirect::to('task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreTask $request)
    {
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
        $board->editable = 'N';
        $board->save();

        if(Input::get('responsible_user') !== null){
            foreach (Input::get('responsible_user') as $key=>$att){
                UserTask::create(['task_id' => $task->id, 'user_id' => $key]);
            }
        }

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
    public function edit($id, Request $request)
    {
        $projects = Project::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose project', '');
        //filtriraj po accountu
        $users = User::all()->pluck('name', 'id');
        $usersO = User::all();
        $status = Status::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose status', '');
        $priorities = Priority::all()->where('account_id', Auth::user()->current_acc)->pluck('label', 'id')->prepend('Choose priority', '');
        $types = TaskType::all()->where('account_id', Auth::user()->current_acc)->pluck('name', 'id')->prepend('Choose type', '');
        $task = Task::find($id);
        $responsibles = UserTask::where('task_id',$id);

        $comments = Comment::where('entity_id', $id)->where('entity_type', 'TASK')->orderBy('id', 'desc')->get();

        /* Required for work table */
        $tasks = Task::where('account_id', Auth::user()
                        ->current_acc)->where('responsible_id', Auth::user()->id)
                            ->pluck('name', 'id')->prepend('Choose task', '');
        /* If you try to edit work from work.index, return to it */
        $request->session()->put('url.intended', 'task/'.$id.'/edit');

        $fields = array();
        // Todo : refactor this
        $roleId = Auth::user()->userAccount()->role_id;
        $projectId = $task->getProjectAttribute()->id;
        $taskTypeId = $task->taskType()->first()->id;

        foreach($task->taskType()->first()->fields()->get() as $field){
            $att = TaskAttribute::where('task_id', $id)->where('task_fields_id', $field->id)->first();
            $val = '';
            if($att != null) $val = $att->value;

            if(Auth::user()->isAdmin()){
                $permission = 'DEL';
            }
            else{
                $fr = FieldRight::where('role_id', $roleId)->where('project_id', $projectId)
                    ->where('task_type_id', $taskTypeId)->where('task_field_id', $field->id);
                if($fr->first() == null){
                    $permission = 'NONE';
                }else{
                    $permission = $fr->first()->permission;
                }

            }
            if($permission == 'NONE') continue;
            $disabled = '';
            if($permission == 'READ') $disabled = 'DISABLED';
            $fields[$field->id] = array('type' => $field->type,
                                            'label' => $field->label,
                                                'value' => $val,
                                                    'disabled' => $disabled,
                                                        'permission' => $permission);

        }
        $global_css = '';
        if($task->permission == 'READ') $global_css = 'disabled';
        return View::make('task.edit')->with('projects',$projects)
                        ->with('users',$users)->with('usersO',$usersO)->with('status',$status)
                            ->with('priorities',$priorities)->with('types',$types)
                                ->with('task',$task)->with('fields',$fields)
                                    ->with('tasks', $tasks)->with('comments', $comments)
                                        ->with('responsibles', $responsibles->get())->with('global_css', $global_css);
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
        if($task->permission != 'NONE' && $task->permission != 'READ'){
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
            UserTask::where('task_id', $task->id)->delete();
            if(Input::get('responsible_user') !== null){
                foreach (Input::get('responsible_user') as $key=>$att){
                    UserTask::create(['task_id' => $task->id, 'user_id' => $key]);
                }
            }
        }
        return Redirect::to('project/'.$task->projects_id.'/edit');
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
