<?php

namespace App\Providers;

use Auth;
use App\Models\Comment;
use Illuminate\Support\ServiceProvider;

class CommentProvider extends ServiceProvider
{
    public function __construct(){
    }

    public function createAttribute($id, $fieldName, $fieldValue=null)
    {

        $comment = new Comment();
        $comment->entity_id = $id;
        $comment->entity_type = 'TASK';
        $comment->user_id = Auth::user()->id;
        $comment->type ='NOTE';
        if($fieldValue != null) {
            $comment->data = Auth::user()->name . ' has set ' . $fieldName . ' to ' . $fieldValue . '.';
        }
        else{
            $comment->data = Auth::user()->name . ' has chainged ' . $fieldName;
        }
        $comment->save();
    }
}
