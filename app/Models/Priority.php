<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model {
    protected   $fillable = ['account_id', 'label'];
    use SoftDeletes;
}
