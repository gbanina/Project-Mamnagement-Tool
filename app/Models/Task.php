<?php

namespace App\Models;

use App\Models\TaskType;
use App\Models\TaskAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\PMTypesHelper;

class Task extends Model {

    use SoftDeletes;

    public function getPermissionAttribute()
    {
        $attribute = $this->getProjectAttribute();
        if($attribute == null)
            return 'NONE';

        return $attribute->getPermissionAttribute();
    }
    public function possibleTypes()
    {
        return $this->project->projectType->posibleTaskTypes()->get();
    }

    public function getTypeAttribute()
    {
        $type =  $this->belongsTo('App\Models\TaskType', 'task_type_id')->first();
        return $type->name;
    }
    public function getStatusAttribute()
    {
        $status = $this->belongsTo('App\Models\Status', 'status_id')->first();
        if($status == null) return 'N/A';
        return $status->name;
    }

    public function getProjectAttribute()
    {
        $project =  $this->belongsTo('App\Models\Project', 'project_id');
        return $project->first();
    }
    public function taskType()
    {
        $type =  $this->belongsTo('App\Models\TaskType', 'task_type_id');
        return $type;
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function responsibleUsers()
    {
        return $this->belongsToMany('App\User', 'user_tasks');
    }
    public function getResponsibleIdAttribute()
    {
        $responsibles = $this->belongsToMany('App\User', 'user_tasks');
        if($responsibles != null)
            return $responsibles->first()->id;

        return null;
    }
    public function getCreatedAtAttribute()
    {
        return PMTypesHelper::dateToHuman($this->attributes['created_at']);
    }
    public function getCloseAttribute()
    {
        return PMTypesHelper::closedToHuman($this->closed);
    }
    public function attributes()
    {
        return $this->hasMany('App\Models\TaskAttribute');
    }
    public function files()
    {
        return $this->hasMany('App\Models\File');
    }
    public function getEstimatedStartDateAttribute()
    {
        return PMTypesHelper::dateToHuman($this->attributes['estimated_start_date']);
    }
    public function getEstimatedEndDateAttribute()
    {
        return PMTypesHelper::dateToHuman($this->attributes['estimated_end_date']);
    }
    public function getCreationDateAttribute()
    {
        return $this->attributes['created_at'];
    }
    public function getRealCostAttribute()
    {
        $cost = $this->hasMany('App\Models\Work');
        return $cost->sum('cost');

    }
    public function getTimesAttribute()
    {
        $cost = $this->hasMany('App\Models\Work', 'task_id');
        return PMTypesHelper::secToTime($cost->sum('time'));
    }
    public function getRealStartDateAttribute()
    {
        $cost = $this->hasMany('App\Models\Work');
        return PMTypesHelper::dateToHuman($cost->min('date'));
    }
    public function getRealEndDateAttribute()
    {
        $cost = $this->hasMany('App\Models\Work');
        return PMTypesHelper::dateToHuman($cost->max('date'));
    }
    public function work()
    {
        return $this->hasMany('App\Models\Work');
    }
    public function responsibles()
    {
        return $this->belongsToMany('App\Models\UserTask', 'task_id')->get()->toArray();//UserTask::where('task_id', $this->id);
    }
}
