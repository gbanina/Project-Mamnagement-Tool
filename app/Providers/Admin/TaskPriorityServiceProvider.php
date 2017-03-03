<?php

namespace App\Providers\Admin;

use Auth;
use App\Models\Priority;
use Illuminate\Support\ServiceProvider;

class TaskPriorityServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all()
    {
        return Priority::where('account_id', Auth::user()->current_acc)->get();
    }

    public function store($args)
    {
        $priority = new Priority();
        $priority->account_id = Auth::user()->current_acc;
        $priority->label = $args['priority-name'];
        $priority->save();

        return $priority;
    }

    public function getPriority($id)
    {
        return Priority::find($id);
    }

    public function update($id, $args)
    {
        $priority = Priority::find($id);
        $priority->label = $args['priority-name'];
        $priority->save();

        return $priority;
    }

    public function destroy($id)
    {
        $priority = Priority::find($id);
        $priority->delete();
    }
}
