<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskField extends Model {
    use SoftDeletes;

    public function permission()
    {
        return $this->hasMany('App\Models\FieldRight', 'task_type_id');
    }
}
