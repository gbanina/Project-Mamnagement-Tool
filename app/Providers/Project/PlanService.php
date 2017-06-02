<?php

namespace App\Providers\Project;

use Auth;
use App\Helpers\PMTypesHelper;
use Illuminate\Support\ServiceProvider;
use App\Models\ProjectPlan;
use App\Models\ProjectTypes;
use App\Models\Project;
use App\Models\Task;
use App\Models\UserTask;

class PlanService extends ServiceProvider
{
    public function __construct(){

    }

    public function run($id)
    {
        $plan = ProjectPlan::find($id);
        $project = $this->createProject($plan);

        $array = unserialize($plan->plan);
        foreach($array['data'] as $task) {
            $this->createTask($task, $project->id);
        }
        return $project;
    }

    private function createTask($data, $projectId)
    {
        $task = new Task();
        $task->internal_id = Auth::user()->currentacc->nextTaskId();
        $task->account_id = Auth::user()->current_acc;
        $task->project_id = $projectId;
        $task->task_type_id = $data['task_types'];
        $task->name = $data['text'];
        $task->archived = 'NO';
        $task->estimated_start_date = PMTypesHelper::webToSQL($data['start_date']);
        $task->estimated_end_date = PMTypesHelper::webToSQL($data['end_date']);
        $task->estimated_cost = $data['duration'] * 8;
        $task->save();

        if($data['responsible'] != 0 && $data['responsible'] != '')
            UserTask::create(['task_id' => $task->id, 'user_id' => $data['responsible']]);
    }
    private function createProject($plan)
    {
        $project = new Project;
        $project->account_id = Auth::user()->current_acc;
        $project->project_type_id = $plan->project_type_id;
        $project->internal_id = Auth::user()->currentacc->nextProjectId();
        $project->name = $plan->name;
        $project->default_responsible = $plan->user_id;
        $project->created_by = Auth::user()->id;
        $project->save();

        return $project;
        /*
        $up = New UserProject;
        $up->user_id = $args['project_manager'];
        $up->project_id = $project->id;
        $up->save();
        */
    }
}
