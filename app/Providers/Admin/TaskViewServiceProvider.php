<?php

namespace App\Providers\Admin;

use Auth;
use App\Models\TaskType;
use App\Models\TaskField;
use App\Models\TaskTypeField;
use Illuminate\Support\ServiceProvider;
use App\Providers\Admin\ProjectTypeServiceProvider;
use App\Providers\Admin\UserServiceProvider;

class TaskViewServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all()
    {
        return TaskType::all()->where('account_id', Auth::user()->current_acc)->where('type', 'TASK_VIEW');
    }
    public function published()
    {
        return TaskType::all()->where('account_id', Auth::user()->current_acc)->where('type', 'TASK_VIEW')->where('status', 'PUBLISHED');
    }

    public function create()
    {
        /*
        $result = array();
        $projectTypeService = new ProjectTypeServiceProvider();
        $result['projectTypes'] = $projectTypeService->all();
        $result['taskFields'] = TaskField::where('account_id', Auth::user()->current_acc)->get();
        return $result;
        */
    }

    public function store($name/*, $arg*/)
    {

        $taskType = new TaskType();
        $taskType->account_id = Auth::user()->current_acc;
        $taskType->name = $name;
        $taskType->type = 'TASK_VIEW';
        $taskType->save();

        /*
        if(isset($arg)){
            $taskType->updateTaskFields($arg);
        }
        */
        return $taskType;
    }

    public function taskTypeFields($id)
    {
        $result = array();
        $fields = array();
        $usedField = array();
        $result['taskTypeFields'] = TaskTypeField::where('task_type_id', $id)->get();
        foreach($result['taskTypeFields'] as $field){
            $fields[$field->row][$field->col][$field->index]
                = array('field' => TaskField::find($field->task_field_id), 'typeField' => $field);
            $usedField[] = $field->task_field_id;
        }
        $result['taskFields'] = TaskField::where('account_id', Auth::user()->current_acc)
                                ->whereNotIn('id', $usedField)->get();
        $result['fields'] = $fields;

        return $result;
    }

    public function edit($id)
    {
        $projectTypeService = new ProjectTypeServiceProvider();
        $userService = new UserServiceProvider();
        $result = array();

        $result['taskType'] = TaskType::find($id);
        $taskTypeFields = $this->taskTypeFields($id);

        $result['taskTypeFields'] = $taskTypeFields['taskTypeFields'];
        $result['taskFields'] = $taskTypeFields['taskFields'];
        $result['fields'] = $taskTypeFields['fields'];

        $result['projectTypes'] = $projectTypeService->all();
        $result['users'] = $userService->selectList();

        $result['usersO']  = $userService->all();
        $result['users']  = $userService->selectList();
        $result['status']  = array('Choose status', '');
        $result['priorities']  = array('Choose priority', '');
        $result['types']  = array('Choose type', '');

        return $result;
    }

    public function update($id, $args, $name, $published)
    {
        $taskType = TaskType::find($id);
        $taskType->status = "IN_PROGRESS";
        //if($published == 'on')
          //  $taskType->status = "PUBLISHED";
        $taskType->status = $published;
        $taskType->name = $name;
        $taskType->save();

        if(isset($args)){
            $taskType->updateTaskFields($args);
        }
    }

    public function copy($sourceId, $destinationId)
    {
        $sourceType = TaskType::find($sourceId);
        $destinationType = TaskType::find($destinationId);

        TaskTypeField::where('task_type_id', $destinationType->id)->delete();

        foreach(TaskTypeField::where('task_type_id', $sourceType->id)->get() as $field) {
            $newField = $field->replicate();
            $newField->task_type_id = $destinationType->id;
            $newField->save();
        }
    }

    public function duplicate($sourceId)
    {
        $sourceType = TaskType::find($sourceId);

        $destinationType = new TaskType();
        $destinationType->account_id = Auth::user()->current_acc;
        $destinationType->name = 'Copy of ' . $sourceType->name;
        $destinationType->type = 'TASK_VIEW';
        $destinationType->save();

        foreach(TaskTypeField::where('task_type_id', $sourceType->id)->get() as $field) {
            $newField = $field->replicate();
            $newField->task_type_id = $destinationType->id;
            $newField->save();
        }

        return $destinationType;
    }

    public function children($sourceId)
    {
        return TaskType::where('parent', $sourceId)->pluck('name');
    }
    public function destroy($id)
    {
        $type = TaskType::find($id);
        $type->delete();
    }
}
