<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccounts extends Model {
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
