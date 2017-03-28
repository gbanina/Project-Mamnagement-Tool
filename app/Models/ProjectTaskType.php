<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTaskType extends Model {
    public      $timestamps = false;
    protected   $fillable = ['project_type_id', 'task_type_id'];

    public function taskTypes()
    {
        return $this->belongsTo('App\Models\TaskType');
        //return $this->hasMany('App\Models\TaskType');
    }
}
