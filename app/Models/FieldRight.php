<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldRight extends Model {
    public $incrementing = false;
    protected $primaryKey = ['role_id', 'project_id','task_type_id', 'task_field_id'];
    protected $fillable = ['role_id', 'project_id', 'task_type_id',
                                    'task_field_id','permission'];
}
