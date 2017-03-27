<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskTypeField extends Model {
    public      $timestamps = false;
    protected   $fillable = ['task_field_id', 'task_type_id'];
}
