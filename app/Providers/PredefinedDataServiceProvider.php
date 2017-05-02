<?php

namespace App\Providers;

use Auth;
use App\Models\TaskField;
use App\Models\Account;
use Illuminate\Support\ServiceProvider;

class PredefinedDataServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function createAccount($userId, $name)
    {
        $account = Account::create(['name' => $name . ' private account',
                            'internal_project_id' => '1000',
                            'internal_task_id' => '1000',
                            'licence' => 'SINGLE',
                            'expires' => '2022-02-15']);
        $role = $this->generateRole($account->id);
        $userAccount = UserAccount::create(['user_id' => $userId,
                                            'account_id' => $account->id,
                                            'role_id' => $role->id]);
        $this->generateTaskFields($account->id);
        $this->generateStatuses($account->id);
        $this->generatePriorities($account->id);
        $this->generateProjectType($account->id);
        $this->generateTaskType($account->id);
        $this->generateTaskView($account->id);
        $this->generateProject($account->id);

    }
    public function generateTaskFields($accId)
    {
        //TaskField::create(['type' => 'TYPE', 'predefined' => 1, 'label' => 'Type', 'account_id' => $accId]);
        TaskField::create(['type' => 'NAME', 'predefined' => 1, 'label' => 'Name', 'account_id' => $accId]);
        TaskField::create(['type' => 'DESCRIPTION', 'predefined' => 1, 'label' => 'Description', 'account_id' => $accId]);
        TaskField::create(['type' => 'RESPONSIBLE', 'predefined' => 1, 'label' => 'Responsible', 'account_id' => $accId]);
        TaskField::create(['type' => 'STATUS', 'predefined' => 1, 'label' => 'Status', 'account_id' => $accId]);
        TaskField::create(['type' => 'PRIORITY', 'predefined' => 1, 'label' => 'Priority', 'account_id' => $accId]);
        TaskField::create(['type' => 'ESTIMATED_START_DATE', 'predefined' => 1, 'label' => 'Estimated Start Date', 'account_id' => $accId]);
        TaskField::create(['type' => 'ESTIMATED_END_DATE', 'predefined' => 1, 'label' => 'Estimated End Date', 'account_id' => $accId]);
        TaskField::create(['type' => 'ESTIMATED_COST', 'predefined' => 1, 'label' => 'Estimated Cost', 'account_id' => $accId]);
    }
    public function generateStatuses()
    {

    }
    public function generatePriorities()
    {

    }
    public function generateRole()
    {

    }
    public function generateProjectType()
    {

    }
    public function generateTaskType()
    {

    }
    public function generateTaskView()
    {

    }
    public function generateProject()
    {

    }
}
