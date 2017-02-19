<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\ProjectTypes;
use App\Models\TaskType;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProjectTypeController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pt = ProjectTypes::all();
        $view = View::make('admin.project-type.index')->with('projectTypes', $pt);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tt = TaskType::all();
        $view = View::make('admin.project-type.create')
                        ->with('hasTaskType', array())
                            ->with('taskTypes', $tt);
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
            'type-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $pt = new ProjectTypes();
        $pt->accounts_id = 1;
        $pt->label =Input::get('type-name');
        $pt->save();
        $pt->updateTaskTypes(Input::get('task_type'));
        $request->session()->flash('alert-success', 'Project Type was successfuly created!');

        return Redirect::to('admin/project-type');
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
        $pt = ProjectTypes::find($id);
        $tt = TaskType::all();
        $hasTaskType = $pt->hasTaskType();
        $view = View::make('admin.project-type.edit')->with('projectType', $pt)
                    ->with('taskTypes', $tt)->with('hasTaskType', $hasTaskType);
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
            'type-label' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        $pt = ProjectTypes::find($id);
        $pt->label = Input::get('type-name');
        $pt->updateTaskTypes(Input::get('task_type'));
        $pt->update();
        $request->session()->flash('alert-success', 'Project Type was successfuly updated!');

        return Redirect::to('admin/project-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $type = ProjectTypes::find($id);
        $type->delete();
        $request->session()->flash('alert-success', 'Project Type was successfuly deleted!');

        return Redirect::to('admin/project-type');
    }

}
