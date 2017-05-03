<?php

namespace App\Providers\Admin;

use Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\ProjectTypes;
use App\Models\TaskType;

class ProjectTypeServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all()
    {
        return ProjectTypes::where('account_id', Auth::user()->current_acc)->get();
    }

    public function getTaskTypes()
    {
        return TaskType::all()->where('account_id', Auth::user()->current_acc)->where('type', 'TASK_TYPE');
    }

    public function store($arg)
    {
        $pt = new ProjectTypes();
        $pt->account_id = Auth::user()->current_acc;
        $pt->label = $arg['type-name'];
        $pt->save();
        if(isset($arg['task_type'])){
            $pt->updateTaskTypes($arg['task_type']);
        }
    }

    public function edit($id)
    {
        $result = array();

        $result['projectTypes'] = ProjectTypes::find($id);
        $result['taskTypes'] = TaskType::all()->where('account_id', Auth::user()->current_acc)->where('type', 'TASK_TYPE');
        $result['hasTaskType'] = $result['projectTypes']->hasTaskType();

        return $result;
    }

    public function update($id, $arg)
    {
        $pt = ProjectTypes::find($id);
        $pt->label = $arg['type-name'];
        if(isset($arg['task_type'])){
            $pt->updateTaskTypes($arg['task_type']);
        }
        $pt->update();
    }

    public function destroy($id)
    {
        $type = ProjectTypes::find($id);
        $type->delete();
    }
}
