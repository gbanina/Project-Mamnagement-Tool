<?php

namespace App\Providers;

use Auth;
use App\Models\Dashboard;
use Illuminate\Support\ServiceProvider;
use App\Providers\BoardServiceProvider;
use App\Models\UserPreference;

class BoardServiceProvider extends ServiceProvider
{
    public function __construct(){
        //
    }
    public function all() {
        $projectService = new ProjectServiceProvider(Auth::user());
        $projectIds = $projectService->all()->pluck('id')->toArray();
        $boards = Dashboard::where('account_id', Auth::user()->current_acc)->whereIn('project_id', $projectIds)->orderBy('id', 'desc');

        return $boards;
    }

    public function countUnseen() {
        $boardService = new BoardServiceProvider();
        $lastBoardId = UserPreference::where('user_id', Auth::user()->id )
                            ->where('account_id', Auth::user()->current_acc)->where('key', 'last_bord')->first()->value;

        $projectService = new ProjectServiceProvider(Auth::user());
        $projectIds = $projectService->all()->pluck('id')->toArray();
        // where user_id != Auth::user()
        $boardsCount = Dashboard::where('account_id', Auth::user()->current_acc)
                  ->whereIn('project_id', $projectIds)->where('id', '>', $lastBoardId)->count();

        return $boardsCount;
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
