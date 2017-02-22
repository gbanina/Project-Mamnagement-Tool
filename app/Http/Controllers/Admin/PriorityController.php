<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\Priority;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PriorityController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $priority = Priority::all();
        $view = View::make('admin.priority.index')->with('priorities', $priority);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'priority-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $priority = new Priority();
        $priority->accounts_id = 1;
        $priority->title =Input::get('title');
        $priority->save();
        $request->session()->flash('alert-success', 'Priority : '.$priority->label.' was successful created!');

        return Redirect::to('admin/priority');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $priority = Priority::find($id);

        $view = View::make('admin.priority.edit')->with('priority', $priority);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $rules = array(
            'priority-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $priority = Priority::find($id);
        $priority->label =Input::get('priority-name');
        $priority->save();

        $request->session()->flash('alert-success', 'Priority : '.$priority->label.' was successful updated!');
        return Redirect::to('admin/priority');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $priority = Priority::find($id);
        $priority->delete();
        $request->session()->flash('alert-success', 'Priority was successful deleted!');

        return Redirect::to('admin/priority');
    }

}
