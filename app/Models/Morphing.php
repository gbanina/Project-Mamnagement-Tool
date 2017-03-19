<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Morphing extends Model {
    public $timestamps = false;
    protected $fillable = ['user_account_id', 'role_id', 'type'];
}
