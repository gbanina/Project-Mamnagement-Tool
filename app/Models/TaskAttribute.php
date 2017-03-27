<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskAttribute extends Model {
    use SoftDeletes;
    protected   $fillable = ['value', 'task_id', 'task_field_id'];
}
