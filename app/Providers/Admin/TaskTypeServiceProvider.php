<?php

namespace App\Providers\Admin;

use Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\TaskType;
use App\Models\TaskField;
use App\Providers\Admin\ProjectTypeServiceProvider;
use App\Providers\Admin\TaskViewServiceProvider;

class TaskTypeServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all()
    {
        return TaskType::all()->where('account_id', Auth::user()->current_acc)->where('type', 'TASK_TYPE');
    }

    public function allViews()
    {
        return TaskType::all()->where('account_id', Auth::user()->current_acc)->where('type', 'TASK_VIEW');
    }


    public function create()
    {
        $result = array();
        $projectTypeService = new ProjectTypeServiceProvider();
        $result['projectTypes'] = $projectTypeService->all();
        $result['taskFields'] = TaskField::where('account_id', Auth::user()->current_acc)->get();
        return $result;
    }

    public function store($arg)
    {
        $taskType = new TaskType();
        $taskType->account_id = Auth::user()->current_acc;
        $taskType->name = $arg['type-name'];
        $taskType->type = 'TASK_TYPE';
        $taskType->save();

        $viewService = new TaskViewServiceProvider();
        $viewService->copy($arg['type_id'], $taskType->id);
        // not using this anymore
        //if(isset($arg['task_field'])){
        //    $taskType->updateTaskFields($arg['task_field']);
        //}


        if(isset($arg['project_type'])){
            $taskType->updateProjectTypes($arg['project_type']);
        }
    }

    public function edit($id)
    {
        $projectTypeService = new ProjectTypeServiceProvider();
        $result = array();

        $result['taskType'] = TaskType::find($id);
        $result['taskFields'] = TaskField::where('account_id', Auth::user()->current_acc)->get();
        $result['projectTypes'] = $projectTypeService->all();

        return $result;
    }

    public function update($id, $args)
    {
        $viewService = new TaskViewServiceProvider();

        $taskType = TaskType::find($id);
        $taskType->name = $args['type-name'];
        $taskType->save();
        /*
        if(isset($args['task_field'])){
            $taskType->updateTaskFields($args['task_field']);
        }
        */
        $viewService->copy($args['type_id'], $taskType->id);

        if(isset($args['project_type'])){
            $taskType->updateProjectTypes($args['project_type']);
        }
    }

    public function destroy($id)
    {
        $type = TaskType::find($id);
        $type->delete();
    }
}
