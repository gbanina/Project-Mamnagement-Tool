<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProjectTaskType;
use App\Models\TaskType;

class ProjectTypes extends Model {
    use SoftDeletes;
    protected   $fillable = ['account_id', 'label'];

    public function updateTaskTypes($array)
    {
        // Transaction
            // First we remove all tast types from current project type
                ProjectTaskType::where('project_type_id', $this->id)->delete();
            // ... then we add selected task types to project
            if($array != null){
                foreach($array as $id){
                    ProjectTaskType::create(['project_type_id' => $this->id, 'task_type_id' => intval ($id)]);
                }
            }
        //End Transactions
    }
    public function posibleTaskTypes()
    {
        return $this->belongsToMany('App\Models\TaskType', 'project_task_types', 'project_type_id', 'task_type_id')->where('type', 'TASK_TYPE');
    }
    public function hasTaskType()
    {
        return ProjectTaskType::where('project_type_id', $this->id)
                                ->pluck(('task_type_id'))->toArray();
    }
}
