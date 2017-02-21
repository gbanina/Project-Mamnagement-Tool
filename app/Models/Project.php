<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\PMTypesHelper;
use App\Models\ProjectTaskType;
use App\Models\ProjectTypes;

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

    public function projectType(){
        return $this->belongsTo('App\Models\ProjectTypes', 'project_types_id');
    }

    public function getTasksAttribute()
    {
        $tasks = DB::table('tasks')->where('projects_id', '=', $this->id);
        return $tasks->get();
    }

    public function getEstimatedStartDateAttribute()
    {
        $item = DB::table('tasks')->where('projects_id', '=', $this->id)->min('estimated_start_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getEstimatedEndDateAttribute()
    {
        $item = DB::table('tasks')->where('projects_id', '=', $this->id)->max('estimated_end_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getRealStartDateAttribute()
    {
        $item = DB::table('tasks')->where('projects_id', '=', $this->id)->max('real_start_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getRealEndDateAttribute()
    {
        $item = DB::table('tasks')->where('projects_id', '=', $this->id)->max('real_end_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getEstimatedCostAttribute()
    {
        $item = DB::table('tasks')->where('projects_id', '=', $this->id)->sum('estimated_cost');
        return $item;
    }
}
