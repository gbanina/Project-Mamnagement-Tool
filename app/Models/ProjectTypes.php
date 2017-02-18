<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProjectTaskType;

class ProjectTypes extends Model {
    use SoftDeletes;

    public function updateTaskTypes($array)
    {
        // Transaction
            // First we remove all tast types from current project type
                ProjectTaskType::where('project_types_id', $this->id)->delete();
            // ... then we add selected task types to project
            if($array != null){
                foreach($array as $id){
                    ProjectTaskType::create(['project_types_id' => $this->id, 'task_types_id' => intval ($id)]);
                }
            }
        //End Transactions
    }
    public function hasTaskType()
    {
        return ProjectTaskType::where('project_types_id', $this->id)
                                ->pluck(('task_types_id'))->toArray();
    }
}
