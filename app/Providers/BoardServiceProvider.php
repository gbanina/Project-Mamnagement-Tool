<?php

namespace App\Providers;

use Auth;
use App\Models\Dashboard;
use Illuminate\Support\ServiceProvider;

class BoardServiceProvider extends ServiceProvider
{
    public function __construct(){
        //
    }
    protected function taskModdify($task, $title, $content){
        $board = new Dashboard;
        $board->account_id = Auth::user()->current_acc;
        $board->user_id = Auth::user()->id;
        $board->project_id = $task->project_id;
        $board->task_id = $task->id;

        $board->title = $title;
        $board->content = $content;
        $board->editable = 'N';
        $board->save();
    }

    public function taskCreate($task) {
        $this->taskModdify($task,
                           "Created a new " . $task->type,
                            $task->internal_id . ':' . $task->name . ' - ' . $task->description);
    }
    public function taskEdit($task) {
        $this->taskModdify($task,
                           "Edited task " . $task->name,
                            $task->internal_id . ':' . $task->name . ' - ' . $task->description);
    }
   public function taskClose($task){
        $this->taskModdify($task,
                    "Closed task " . $task->name,
                    $task->internal_id . ':' . $task->name . ' - ' . ' has been CLOSED.');
   }
   public function taskReopen($task){
        $this->taskModdify($task,
                    "Reopened task " . $task->name,
                    $task->internal_id . ':' . $task->name . ' - ' . ' has been REOPENED.');
   }
   public function taskDelete($task){
        $this->taskModdify($task,
                    "Deleted task " . $task->name,
                    $task->internal_id . ':' . $task->name . ' - ' . ' has been DELETED.');
   }
}
