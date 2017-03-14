<?php

namespace App\Models;

use App\Models\TaskTypeField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskType extends Model {
    use SoftDeletes;

    public function updateTaskFields($array){
        // Transaction
            // First we remove all task fields from current task type
                TaskTypeField::where('task_types_id', $this->id)->delete();
            // ... then we add selected task types to project

            if($array != null){
                foreach($array as $id){
                    TaskTypeField::create(['task_types_id' => $this->id, 'task_fields_id' => intval ($id)]);
                }
            }
        //End Transactions
    }

    public function fields()
    {
        return $this->belongsToMany('App\Models\TaskField', 'task_type_fields', 'task_types_id', 'task_fields_id');
    }

    public function hasTaskField()
    {
        return TaskTypeField::where('task_types_id', $this->id)
                                ->pluck(('task_fields_id'))->toArray();
    }
}
