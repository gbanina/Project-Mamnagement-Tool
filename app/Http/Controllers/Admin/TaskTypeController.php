<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\TaskType;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class TaskTypeController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tt = TaskType::all();
        $view = View::make('admin.task-type.index')->with('roles', $tt);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.task-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'role-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $tt = new TaskType();
        $tt->owner_id = 1;
        $tt->name =Input::get('role-name');
        $tt->save();

        return Redirect::to('admin/task-type');
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
        $tt = TaskType::find($id);

        $view = View::make('admin.task-type.edit')->with('taskTypes', $tt);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'role-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $role = TaskType::find($id);
        $role->name =Input::get('role-name');
        $role->save();

        return Redirect::to('admin/task-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}
