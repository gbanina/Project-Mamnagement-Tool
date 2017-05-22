<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\PMTypesHelper;
use App\Models\ProjectTaskType;
use App\Models\ProjectTypes;
use App\User;
use App\Models\UserTask;

class Project extends Model {
    use SoftDeletes;
    protected   $fillable = ['account_id', 'internal_id', 'project_type_id',
                                'created_by', 'name', 'default_responsible'];

    public function getTypeAttribute()
    {
        //Todo : refactor this!!!
        $type = DB::table('project_types')->find($this->project_type_id);
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
        return $this->belongsTo('App\Models\ProjectTypes'/*, 'project_type_id'*/);
    }

    public function projectRight()
    {
        return $this->hasMany('App\Models\ProjectRight');
    }

    public function getTasksAttribute()
    {
        $tasks = $this->hasMany('App\Models\Task', 'project_id')->where('closed', '0');
        return $tasks->get();
    }

    public function getEstimatedStartDateAttribute()
    {
        $item = $this->hasMany('App\Models\Task', 'project_id')->min('estimated_start_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getEstimatedEndDateAttribute()
    {
        $item = $this->hasMany('App\Models\Task', 'project_id')->max('estimated_end_date');
        return PMTypesHelper::dateToHuman($item);
    }
    public function getRealStartDateAttribute()
    {
        return $this->hasMany('App\Models\Task', 'project_id')
                    ->join('works','works.task_id', 'tasks.id')->min('works.date');
    }
    public function getRealEndDateAttribute()
    {
        return $this->hasMany('App\Models\Task', 'project_id')
                    ->join('works','works.task_id', 'tasks.id')->max('works.date');
    }
    public function getEstimatedCostAttribute()
    {
        return $this->hasMany('App\Models\Task', 'project_id')->sum('estimated_cost');
    }
    public function getRealCostAttribute()
    {
        $tasks = $this->hasMany('App\Models\Task', 'project_id')->get();
        return $tasks->sum('realCost');
    }
    public function getResponsibleUsersAttribute()
    {
        $taskIds = $this->hasMany('App\Models\Task', 'project_id')->pluck('id');
        $userIds = UserTask::whereIn('task_id', $taskIds->toArray())->pluck('user_id')->unique();
        return User::whereIn('id', $userIds->toArray())->limit(4)->get();
    }
    public function getResponsibleUserAttribute()
    {

        return User::find($this->default_responsible)->name;
    }
    public function getProjectManagerAttribute()
    {
        $userProject = $this->hasOne('App\Models\UserProject', 'project_id');
        if($userProject->first()!= null)
            return User::find($userProject->first()->user_id)->name;
        else return '';
    }
}
