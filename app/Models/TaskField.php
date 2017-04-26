<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskField extends Model {
    use SoftDeletes;
    protected   $fillable = ['type', 'predefined', 'label', 'account_id'];

    public function permission()
    {
        return $this->hasMany('App\Models\FieldRight', 'task_type_id');
    }
    // Move to Service provider?
    public function updateTaskTypes($array){
        // Transaction
            TaskTypeField::where('task_field_id', $this->id)->delete();
            if($array != null){
                foreach($array as $id){
                    TaskTypeField::create(['task_field_id' => $this->id, 'task_type_id' => intval ($id)]);
                }
            }
        //End Transactions
    }
    public function belongsToTaskType(){
        return TaskTypeField::where('task_field_id', $this->id);
    }
}
