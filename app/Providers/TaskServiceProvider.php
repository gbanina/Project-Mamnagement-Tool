<?php

namespace App\Providers;

use App\Models\UserTask;
use App\Models\TaskAttribute;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    public function __construct()
    { }
    public function setAdditional($taskId, $additional)
    {
        //TaskAttribute::where('task_id', $taskId)->delete();
        if($additional !== null){
            foreach ($additional as $key=>$att){
                 $attirbute = TaskAttribute::where('task_id', $taskId)->where('task_field_id', $key)->first();
                 if($attirbute == null)
                    TaskAttribute::create(['task_id' => $taskId, 'task_field_id' => $key, 'value' => $att]);
                 else{
                    $attirbute->value = $att;
                    $attirbute->save();
                 }
            }
        }
    }

    public function setResponsible($taskId, $responsibleId)
    {
        UserTask::where('task_id', $taskId)->delete();
        if($responsibleId !== null){
            UserTask::create(['task_id' => $taskId, 'user_id' => $responsibleId]);
        }
    }

}
