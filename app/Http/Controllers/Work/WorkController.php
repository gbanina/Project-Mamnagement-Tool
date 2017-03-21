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
    public function index(Request $request)
    {
        $work = Work::where('account_id', Auth::user()->current_acc)
                        ->where('user_id', Auth::user()->id)->where('created_at', '>', date('Y-m-d 00:00:00',strtotime('last monday')));
        $tasks = Task::where('account_id', Auth::user()
                        ->current_acc)->where('responsible_id', Auth::user()->id)
                            ->pluck('name', 'id')->prepend('Choose task', '');

        /* If you try to edit work from work.index, return to it */
        $request->session()->put('url.intended', 'work');

        $view = View::make('work.index')->with('works', $work->get())
                ->with('tasks', $tasks)->with('cost', $work->sum('cost'));
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'task_id' => 'required',
            'cost' => 'number',
        );

        $validator = Validator::make(Input::all(), $rules);

        $work = new Work;
        $work->account_id = Auth::user()->current_acc;
        $work->user_id = Auth::user()->id;
        $work->task_id = Input::get('task_id');
        $work->cost = Input::get('cost');
        $work->save();

        $request->session()->flash('alert-success', 'Work for '.$work->task->name.' was successful created!');

        if( null == Input::get('return_to') )
            abort(403, 'Unauthorized action.');

        return Redirect::to(Input::get('return_to'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $work = Work::find($id);
        $tasks = Task::where('account_id', Auth::user()
                        ->current_acc)->where('responsible_id', Auth::user()->id)
                            ->pluck('name', 'id')->prepend('Choose task', '');

        return View::make('work.edit')->with('tasks', $tasks)->with('work', $work);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $work = Work::find($id);
        $work->task_id = Input::get('task_id');
        $work->cost = Input::get('cost');
        $work->save();
        $request->session()->flash('alert-success', 'Work : ID:'.$work->task_id.' was successful updated!');
        return Redirect::to($request->session()->get('url.intended'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $work = Work::find($id);
        $work->delete();
        $request->session()->flash('alert-success', 'Work was successful deleted!');

        return Redirect::back();
    }
}
