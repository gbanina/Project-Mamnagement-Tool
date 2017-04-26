<?php

namespace App\Providers;

use Auth;
use App\Models\TaskField;
use Illuminate\Support\ServiceProvider;

class PredefinedDataServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function generateTaskFields()
    {
        TaskField::create(['type' => 'TYPE', 'predefined' => 1, 'label' => 'Type', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'NAME', 'predefined' => 1, 'label' => 'Name', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'DESCRIPTION', 'predefined' => 1, 'label' => 'Description', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'RESPONSIBLE', 'predefined' => 1, 'label' => 'Responsible', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'STATUS', 'predefined' => 1, 'label' => 'Status', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'PRIORITY', 'predefined' => 1, 'label' => 'Priority', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'ESTIMATED_START_DATE', 'predefined' => 1, 'label' => 'Estimated Start Date', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'ESTIMATED_END_DATE', 'predefined' => 1, 'label' => 'Estimated End Date', 'account_id' => Auth::user()->current_acc]);
        TaskField::create(['type' => 'ESTIMATED_COST', 'predefined' => 1, 'label' => 'Estimated Cost', 'account_id' => Auth::user()->current_acc]);
    }
}
