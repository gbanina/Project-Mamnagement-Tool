<?php

namespace App\Models;

use DB;
use Auth;
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

    public function getPermissionAttribute()
    {
        if(Auth::user()->isAdmin())
        {
            return 'DEL';
        }
        $roleId = Auth::user()->currentRole()->first()->id;
        $projectRight = $this->projectRight()->where('role_id', $roleId)->first();

        if($projectRight == null){
            return 'NONE';
        }

        return $projectRight->permission;
    }

    public function projectType()
    {
        return $this->belongsTo('App\Models\ProjectTypes', 'project_types_id');
    }

    public function projectRight()
    {
        return $this->hasMany('App\Models\ProjectRight');
    }

    public function getTasksAttribute()
    {
        $tasks = $this->hasMany('App\Models\Task', 'projects_id');
        return $tasks->get();
    }

    public function getEstimatedStartDateAttribute()
    {
        $item = $this->hasMany('App\Models\Task', 'projects_id')->min('estimated_start_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getEstimatedEndDateAttribute()
    {
        $item = $this->hasMany('App\Models\Task', 'projects_id')->max('estimated_end_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getRealStartDateAttribute()
    {
        return $this->hasMany('App\Models\Task', 'projects_id')
                    ->join('works','works.task_id', 'tasks.id')->min('works.date');
    }
    public function getRealEndDateAttribute()
    {
        return $this->hasMany('App\Models\Task', 'projects_id')
                    ->join('works','works.task_id', 'tasks.id')->max('works.date');
    }
    public function getEstimatedCostAttribute()
    {
        return $this->hasMany('App\Models\Task', 'projects_id')->sum('estimated_cost');
    }
    public function getRealCostAttribute()
    {
        $tasks = $this->hasMany('App\Models\Task', 'projects_id')->get();
        return $tasks->sum('realCost');
    }
}
