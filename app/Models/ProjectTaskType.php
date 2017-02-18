<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTaskType extends Model {
    public      $timestamps = false;
    protected   $fillable = ['project_types_id', 'task_types_id'];
}
