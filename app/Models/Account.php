<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model {
    use SoftDeletes;

    public function nextTaskId()
    {
        $next = $this->internal_task_id;
        $this->internal_task_id++;
        $this->save();
        return $next;
    }
    public function nextProjectId()
    {
        $next = $this->internal_project_id;
        $this->internal_project_id++;
        $this->save();
        return $next;
    }
}
