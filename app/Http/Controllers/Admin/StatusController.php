<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\Status;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StatusController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $statuses = Status::all();
        $view = View::make('admin.status.index')->with('statuses', $statuses);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'status-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $status = new Status();
        $status->accounts_id = 1;
        $status->name =Input::get('status-name');
        $status->save();
        $request->session()->flash('alert-success', 'Status : '.$status->name.' was successful created!');

        return Redirect::to('admin/status');
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
        $status = Status::find($id);

        $view = View::make('admin.status.edit')->with('status', $status);
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
            'status-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $status = Status::find($id);
        $status->name =Input::get('status-name');
        $status->save();

        $request->session()->flash('alert-success', 'Status : '.$status->name.' was successful updated!');
        return Redirect::to('admin/status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $status = Status::find($id);
        $status->delete();
        $request->session()->flash('alert-success', 'Status was successful deleted!');

        return Redirect::to('admin/status');
    }

}
