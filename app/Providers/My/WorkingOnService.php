<?php

namespace App\Providers\My;

use Auth;
use App\Models\WorkingOn;
use App\Models\Work;
use Illuminate\Support\ServiceProvider;


class WorkingOnService extends ServiceProvider
{
    public function __construct(){
        //
    }
    public function closeActive()
    {
        $activeWork = WorkingOn::where('account_id', Auth::user()->current_acc)
                            ->where('user_id', Auth::user()->id)->get();

        foreach($activeWork as $aw) {
            $this->close($aw->task_id, $aw->start_time);
            $aw->delete();
        }
    }

    public function close($taskId, $startTime) {
        $work = new Work();
        $work->account_id = Auth::user()->current_acc;
        $work->task_id = $taskId;
        $work->user_id = Auth::user()->id;
        $work->start_time = $startTime;
        $work->end_time = new \DateTime();

        $dteStart = new \DateTime($work->start_time.'');
        $dteEnd   = new \DateTime();
        $dteDiff  = $dteStart->diff($dteEnd);
        $work->time = $dteDiff->format("%H:%I:%S");
        //$diff = date_diff($work->start_time, $work->end_time);
        //dd($dteDiff->format("%H:%I:%S"));

        $work->save();
    }

    public function userWorksOn($userId) {
        $working = WorkingOn::where('account_id', Auth::user()->current_acc)
                            ->where('user_id', Auth::user()->id)->first();

        return $working;
    }

    public function new($taskId) {
        $work = new WorkingOn();

        $work->account_id = Auth::user()->current_acc;
        $work->user_id = Auth::user()->id;
        $work->task_id = $taskId;
        $work->start_time = new \DateTime();
        $work->save();
    }
}
