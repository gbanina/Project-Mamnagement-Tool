<?php

namespace App\Providers\Admin;

use Auth;
use App\Models\Status;
use Illuminate\Support\ServiceProvider;

class TaskStatusServiceProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all()
    {
        return Status::all()->where('account_id', Auth::user()->current_acc);
    }

    public function store($args)
    {
        $status = new Status();
        $status->account_id = Auth::user()->current_acc;
        $status->name =$args['status-name'];
        $status->save();

        return $status;
    }

    public function getStatus($id)
    {
        return Status::find($id);
    }

    public function update($id, $args)
    {
        $status = Status::find($id);
        $status->name = $args['status-name'];
        $status->save();

        return $status;
    }

    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
    }
}
