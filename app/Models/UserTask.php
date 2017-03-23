<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/* Should this be linked to user_acc instead of user? */
class UserTask extends Model {
    public $incrementing = false;
    protected $primaryKey = ['user_id', 'task_id'];
    protected   $fillable = ['user_id', 'task_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
