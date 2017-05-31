<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectPlan extends Model {

    /*protected $casts = [
        'plan' => 'array',
    ];*/
    public function type() {
        return $this->belongsTo('App\Models\ProjectTypes', 'project_type_id');
    }
}
