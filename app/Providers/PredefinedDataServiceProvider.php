<?php

namespace App\Providers;

use Auth;
use App\User;
use App\Models\TaskField;
use App\Models\Account;
use App\Models\Status;
use App\Models\Priority;
use App\Models\Role;
use App\Models\ProjectTypes;
use App\Models\TaskType;
use App\Models\Project;
use App\Models\TaskTypeField;
use App\Models\ProjectTaskType;
use App\Models\UserAccounts;
use Illuminate\Support\ServiceProvider;

class PredefinedDataServiceProvider extends ServiceProvider
{
    public function __construct($userId, $name)
    {
        $account    = $this->createAccount($userId, $name);
        $role       = $this->generateRole($account->id);
        $userAccount = UserAccounts::create(['user_id' => $userId,
                                            'account_id' => $account->id,
                                            'role_id' => $role->id,
                                            'type' => 'OWNER']);

                    $this->generateStatuses($account->id);
                    $this->generatePriorities($account->id);
        $projectType = $this->generateProjectType($account->id);
        $view = $this->generateTaskView($account->id, $projectType->id);
        $taskType = $this->generateTaskType($account->id, $view->id, $projectType->id);
        $this->generateTaskFields($account->id, $taskType->id);

        $this->generateProject($account, $projectType->id, $userId);
        $this->setCurrentAcc($userId, $account->id);
    }

    public function createAccount($userId, $name)
    {
        return Account::create(['name' => $name . ' private account',
                            'internal_project_id' => '1000',
                            'internal_task_id' => '1000',
                            'licence' => 'SINGLE',
                            'expires' => '2022-02-15']);
    }
    public function generateTaskFields($accId, $taskTypeId, $taskViewId)
    {
        $field = TaskField::create(['type' => 'NAME', 'predefined' => 1, 'label' => 'Name', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '0', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '0', 'required' => '0']);
        $field = TaskField::create(['type' => 'RESPONSIBLE', 'predefined' => 1, 'label' => 'Responsible', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '1', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '1', 'required' => '0']);
        $field = TaskField::create(['type' => 'STATUS', 'predefined' => 1, 'label' => 'Status', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '2', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '2', 'required' => '0']);
        $field = TaskField::create(['type' => 'PRIORITY', 'predefined' => 1, 'label' => 'Priority', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '3', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '1', 'index' => '3', 'required' => '0']);
        $field = TaskField::create(['type' => 'ESTIMATED_START_DATE', 'predefined' => 1, 'label' => 'Estimated Start Date', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '2', 'index' => '0', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '2', 'index' => '0', 'required' => '0']);
        $field = TaskField::create(['type' => 'ESTIMATED_END_DATE', 'predefined' => 1, 'label' => 'Estimated End Date', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '2', 'index' => '1', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '2', 'index' => '1', 'required' => '0']);
        $field = TaskField::create(['type' => 'ESTIMATED_COST', 'predefined' => 1, 'label' => 'Estimated Cost', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '2', 'index' => '2', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '1', 'col' => '2', 'index' => '2', 'required' => '0']);
        $field = TaskField::create(['type' => 'DESCRIPTION', 'predefined' => 1, 'label' => 'Description', 'account_id' => $accId]);
        TaskTypeField::create(['task_type_id' => $taskTypeId, 'task_field_id' => $field->id,
                                'row'  => '2', 'col' => '1', 'index' => '0', 'required' => '0']);
        TaskTypeField::create(['task_type_id' => $taskViewId, 'task_field_id' => $field->id,
                                'row'  => '2', 'col' => '1', 'index' => '0', 'required' => '0']);

    }
    public function generateStatuses($id)
    {
        Status::create(['account_id' => $id, 'name' => 'Open']);
        Status::create(['account_id' => $id, 'name' => 'In Progress']);
        Status::create(['account_id' => $id, 'name' => 'Closed']);
    }
    public function generatePriorities($id)
    {
        Priority::create(['account_id' => $id, 'label' => 'High']);
        Priority::create(['account_id' => $id, 'label' => 'Medium']);
        Priority::create(['account_id' => $id, 'label' => 'Low']);
    }
    public function generateRole($id)
    {
        return Role::create(['account_id' => $id, 'name' => 'Custom role 1']);
    }
    public function generateProjectType($id)
    {
        return ProjectTypes::create(['account_id' => $id, 'label' => 'My Project Type']);
    }
    public function generateTaskView($id, $projectTypeId)
    {
        $taskType = TaskType::create(['account_id' => $id, 'status' => 'PUBLISHED',
                        'type' => 'TASK_VIEW', 'name' => 'My Task View']);

        ProjectTaskType::create(['task_type_id' => $taskType->id, 'project_type_id' => $projectTypeId]);

        return $taskType;
    }
    public function generateTaskType($id, $viewId, $projectTypeId)
    {
        $taskType = TaskType::create(['account_id' => $id, 'parent'=> $viewId, 'status' => 'IN_PROGRESS',
                        'type' => 'TASK_TYPE', 'name' => 'My Task Type']);

        ProjectTaskType::create(['task_type_id' => $taskType->id, 'project_type_id' => $projectTypeId]);

        return $taskType;
    }

    public function generateProject($acc, $projectType, $userId)
    {
        return Project::create(['account_id' => $acc->id,
                                'created_by' => $userId,
                                'internal_id' => $acc->nextProjectId(),
                                'project_type_id' => $projectType,
                                'name' => 'My Personal Project',
                                'default_responsible' => $userId]);
    }
    public function setCurrentAcc($userId, $accId)
    {
        $user = User::find($userId);
        $user->current_acc = $accId;
        $user->update();
    }
}
