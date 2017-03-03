<?php

namespace App\Providers\Admin;

use Auth;
use App\Models\TaskField;
use Illuminate\Support\ServiceProvider;

class TaskFieldServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all()
    {
        return TaskField::where('account_id', Auth::user()->current_acc)->get();
    }

    public function store($args)
    {
        $taskField = new TaskField();
        $taskField->account_id = Auth::user()->current_acc;
        $taskField->label = $args['field-name'];
        $taskField->type = $args['field-type'];
        $taskField->save();
    }

    public function getTaskField($id)
    {
        return TaskField::find($id);
    }

    public function update($id, $args)
    {
        $taskField = TaskField::find($id);
        $taskField->label = $args['field-name'];
        $taskField->type = $args['field-type'];
        $taskField->save();
    }

    public function destroy($id)
    {
        $taskField = TaskField::find($id);
        $taskField->delete();
    }
}
