<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectRight extends Model {
    public $incrementing = false;
    protected $primaryKey = ['role_id', 'project_id'];
    protected   $fillable = ['role_id', 'project_id', 'permission'];
}
