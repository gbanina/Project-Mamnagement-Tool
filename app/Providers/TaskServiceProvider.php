<?php

namespace App\Providers;

use App\Models\UserTask;
use App\Models\TaskField;
use App\Models\TaskAttribute;
use Illuminate\Support\ServiceProvider;
use App\Providers\CommentProvider;
use App\Helpers\PMTypesHelper;
use App\Models\Task;
use App\Models\Priority;
use App\Models\Status;
use App\User;

class TaskServiceProvider extends ServiceProvider
{

    public function __construct()
    {    }

    public function setDefaultFields($taskId, $args) {
            $task = Task::find($taskId);
            $commentsService = new CommentProvider();

            if(isset($args['name'])){
                if($task->name != $args['name']){
                    $task->name = $args['name'];
                    $commentsService->createAttribute($taskId, 'Name', $args['name']);
                }
            }
            if(isset($args['status_id'])){
                if($task->status_id != $args['status_id']){
                    $task->status_id = $args['status_id'];
                    $status = Status::find($args['status_id']);
                    $commentsService->createAttribute($taskId, 'Status', $status->first()->name);
                }
            }
            if(isset($args['priority_id'])){
                if($task->priority_id != $args['priority_id']){
                    $task->priority_id = $args['priority_id'];
                    $priority = Priority::find($args['priority_id']);
                    $commentsService->createAttribute($taskId, 'Priority', $priority->first()->label);
                }
            }
            if(isset($args['description'])){
                if($task->description != $args['description']){
                    $task->description = $args['description'];
                    $commentsService->createAttribute($taskId, 'Description');
                }
            }
            if(isset($args['estimated_start_date'])){
                if($task->estimated_start_date != $args['estimated_start_date']){
                    $task->estimated_start_date = PMTypesHelper::dateToSQL($args['estimated_start_date']);
                    $commentsService->createAttribute($taskId, 'Estimated start Date', $args['estimated_start_date']);
                }
            }
            if(isset($args['estimated_end_date'])){
                if($task->estimated_end_date != $args['estimated_end_date']){
                    $task->estimated_end_date = PMTypesHelper::dateToSQL($args['estimated_end_date']);
                    $commentsService->createAttribute($taskId, 'Estimated end Date', $args['estimated_end_date']);
                }
            }
            if(isset($args['estimated_cost'])){
                if($task->estimated_cost != $args['estimated_cost']){
                    $task->estimated_cost = $args['estimated_cost'];
                    $commentsService->createAttribute($taskId, 'Estimated Cost', $args['estimated_cost']);
                }
            }

            $task->update();
    }

    public function setAdditional($taskId, $additional)
    {
        $commentsService = new CommentProvider();
        //TaskAttribute::where('task_id', $taskId)->delete();
        if($additional !== null){
            foreach ($additional as $key=>$att){
                 $attirbute = TaskAttribute::where('task_id', $taskId)->where('task_field_id', $key)->first();
                 if($attirbute == null) // if attribute dose not exist, create new one
                    TaskAttribute::create(['task_id' => $taskId, 'task_field_id' => $key, 'value' => $att]);
                 else{
                    if($attirbute->value != $att){
                        $attirbute->value = $att;
                        $attirbute->save();
                        $taskField = TaskField::find($key);

                        $commentsService->createAttribute($taskId, $taskField->first()->label, $att);
                    }
                 }
            }
        }
    }

    public function setResponsible($taskId, $responsibleId)
    {
        $commentsService = new CommentProvider();
        UserTask::where('task_id', $taskId)->delete();
        if($responsibleId !== null){
            $userTask = UserTask::create(['task_id' => $taskId, 'user_id' => $responsibleId]);
            $user = $userTask->user()->first();
            $commentsService->createAttribute($taskId, 'Responsible', $user->name);
        }
    }
}
