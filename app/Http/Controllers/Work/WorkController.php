<?php

namespace App\Http\Controllers\Work;

use DB;
use View;
use Auth;
use Redirect;
use Session;
use App\Models\Work;
use App\Models\Task;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class WorkController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $work = Work::where('account_id', Auth::user()->current_acc)->where('user_id', Auth::user()->id);
        $tasks = Task::where('account_id', Auth::user()
                        ->current_acc)->where('  responsible_id', Auth::user()->id)
                            ->pluck('name', 'id')->prepend('Choose task', '');

        $view = View::make('work.index')->with('works', $work->get())->with('tasks', $tasks->get());
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $work = new Work;
        $work->account_id = Auth::user()->current_acc;
        $work->user_id = Auth::user()->id;
        $work->task_id = Input::get('task_id');
        $work->cost = Input::get('cost');

        $request->session()->flash('alert-success', 'Work : '.''.' was successful created!');
        return Redirect::to('work.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $request->session()->flash('alert-success', 'work : '.''.' was successful deleted!');
        return Redirect::to('work');
    }

}
