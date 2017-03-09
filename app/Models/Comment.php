<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\PMTypesHelper;

class Comment extends Model {
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getTimeElapsedAttribute(){
        return PMTypesHelper::timeElapsedString($this->created_at);
    }
}
