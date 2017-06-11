<?php

namespace App\Providers;

use Auth;
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
use TMBS;
use App\Providers\EmailProvider;

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
                        $taskField = TaskField::where('id', $key)->first(); //TaskField::find() not working?
                        $fieldName = $taskField->label;

                        if($taskField->type == 'TEXTAREA'){
                            $commentsService->createAttribute($taskId, $fieldName);
                        }else if($taskField->type == 'USER'){
                            $commentsService->createAttribute($taskId, $fieldName, User::find(intval($att))->name);
                        }else{
                            $commentsService->createAttribute($taskId, $fieldName, $att);
                        }

                    }
                 }
            }
        }
    }

    public function setResponsible($taskId, $responsibleId)
    {
        $commentsService = new CommentProvider();
        $emailService = new EmailProvider();

        if($responsibleId !== null){
            // Todo refactor this!
            $userTask = UserTask::orderBy('updated_at', 'desc')->where('task_id', $taskId)->first();
            if($userTask->user_id != $responsibleId){
                $user = User::find($responsibleId);//$userTask->user()->first();
                $commentsService->createAttribute($taskId, 'Responsible', $user->name);
                if(Auth::user()->id != $responsibleId){
                    $url = TMBS::url('task/'.$taskId.'/edit');
                    $emailService->taskAssign($user->email, $user->name, $userTask->task->name,
                                                        $userTask->task->getTypeAttribute(),  $url);
                }
            }
            UserTask::where('task_id', $taskId)->delete();
            UserTask::create(['task_id' => $taskId, 'user_id' => $responsibleId]);
        }
    }
}
