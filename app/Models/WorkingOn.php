<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingOn extends Model
{
    public function task()
    {
        $task =  $this->belongsTo('App\Models\Task'/*, 'task_type_id'*/);
        return $task;
    }
}
