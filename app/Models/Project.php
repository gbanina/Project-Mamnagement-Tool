<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Project extends Model {
    use SoftDeletes;

    public function getTypeAttribute()
    {
        //Todo : refactor this!!!
        //$type =  $this->hasOne('App\Models\ProjectTypes', 'fk_tasks_task_types1_idx');
        //$result = TaskType::find($this->task_types_id)->get();
        $type = DB::table('project_types')->find($this->project_types_id);
        return $type->label;
    }
    public function getTasksAttribute()
    {
        $tasks = DB::table('tasks')->where('projects_id', '=', $this->id);
        return $tasks->get();
    }
}
