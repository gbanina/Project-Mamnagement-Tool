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
        return Status::orderBy('index', 'asc')->where('account_id', Auth::user()->current_acc)->get();
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

    public function predifineIndexes(){
        $all = Status::orderBy('index', 'asc')->where('account_id', Auth::user()->current_acc)->get(); //orderBy('index', 'desc')
        $i = 0;
        foreach($all as $status) {
            $status->index = $i;
            $status->save();
            $i++;
        }
    }

    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();
    }
}
