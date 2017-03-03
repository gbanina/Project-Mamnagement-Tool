<?php

namespace App\Providers\Admin;

use Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\TaskType;
use App\Models\TaskField;

class TaskTypeServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all()
    {
        return TaskType::all()->where('account_id', Auth::user()->current_acc);
    }

    public function create()
    {
        return TaskField::where('account_id', Auth::user()->current_acc);
    }

    public function store($arg)
    {
        $taskType = new TaskType();
        $taskType->account_id = Auth::user()->current_acc;
        $taskType->name = $arg['type-name'];
        $taskType->save();
        if(isset($arg['task_field'])){
            $taskType->updateTaskFields($arg['task_field']);
        }
    }

    public function edit($id)
    {
        $result = array();

        $result['taskType'] = TaskType::find($id);
        $result['taskFields'] = TaskField::where('account_id', Auth::user()->current_acc)->get();

        return $result;
    }

    public function update($id, $args)
    {
        $taskType = TaskType::find($id);
        $taskType->name = $args['type-name'];
        $taskType->save();
        if(isset($args['task_field'])){
            $taskType->updateTaskFields($args['task_field']);
        }
    }

    public function destroy($id)
    {
        $type = TaskType::find($id);
        $type->delete();
    }
}
