<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
    use SoftDeletes;
    protected   $fillable = ['account_id', 'name'];

    // Todo ne valja logika, tu fali project_id !!!
    public function getProjectRightAttribute($project)
    {
        return ProjectRight::where('role_id', $this->id)->where('project_id', $project)->pluck('permission')->first();
    }

    public function getFieldRightAttribute($project, $taskType, $field)
    {
        return FieldRight::where('role_id', $this->id)->pluck('permission')->first();
    }
}
